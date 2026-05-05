<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TeacherController extends Controller
{
    private function api(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withToken(session('api_token'))
            ->baseUrl(config('services.api.base_url'));
    }

    public function dashboard()
    {
        $user = session('user');

        if (!$user || session('role') !== 'teacher') {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
        }

        $response = $this->api()->get('/api/classes');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired.']);
        }

        $flatList = $response->json() ?? [];

        $classes = array_map(function ($basicClass) {
            $detail   = $this->api()->get("/api/classes/{$basicClass['id']}")->json() ?? [];
            $students = $detail['students'] ?? [];

            $students = array_map(function ($student) use ($basicClass) {
                $sessions = $this->api()
                    ->get("/api/students/{$student['id']}/sessions")
                    ->json() ?? [];

                $withScores = array_filter($sessions, fn($s) =>
                    !is_null($s['accuracy_score'] ?? $s['score'] ?? null)
                );
                $latest = count($withScores) ? end($withScores) : null;

                $student['class_id']         = $basicClass['id'];
                $student['latest_score']     = $latest
                    ? ($latest['accuracy_score'] ?? $latest['score'] ?? null)
                    : null;
                $student['sessions_count']   = count($sessions);
                $student['pending_sessions'] = count(array_filter($sessions,
                    fn($s) => ($s['status'] ?? '') === 'pending'
                ));
                return $student;
            }, $students);

            $detail['students'] = $students;
            return $detail;
        }, $flatList);

        $recentSessions = [];
        foreach ($classes as $class) {
            foreach ($class['students'] ?? [] as $student) {
                $sessions = $this->api()
                    ->get("/api/students/{$student['id']}/sessions")
                    ->json() ?? [];
                foreach ($sessions as $session) {
                    $session['student_name'] = $student['name'];
                    $session['student_id']   = $student['id'];
                    $session['class_id']     = $class['id'];
                    $session['score']        = $session['accuracy_score'] ?? $session['score'] ?? null;
                    $recentSessions[]        = $session;
                }
            }
        }

        usort($recentSessions, fn($a, $b) =>
            strtotime($b['updated_at'] ?? 0) - strtotime($a['updated_at'] ?? 0)
        );

        return view('teacher.dashboard', compact('classes', 'user', 'recentSessions'));
    }
    public function showClass(int $classId)
    {
        $response = $this->api()->get("/api/classes/{$classId}");

        if (in_array($response->status(), [401, 403])) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        $class    = $response->json();
        $students = $class['students'] ?? [];

        // Enrich each student with their latest session score
        // so the class page can show the traffic-light cards
        $students = array_map(function ($student) use ($classId) {
            $sessions = $this->api()
                ->get("/api/students/{$student['id']}/sessions")
                ->json() ?? [];

            $withScores = array_filter($sessions, fn($s) =>
                !is_null($s['accuracy_score'] ?? $s['score'] ?? null)
            );

            $latest = count($withScores)
                ? end($withScores)
                : null;

            $student['latest_score']      = $latest
                ? ($latest['accuracy_score'] ?? $latest['score'] ?? null)
                : null;
            $student['sessions_count']    = count($sessions);
            $student['pending_sessions']  = count(array_filter($sessions,
                fn($s) => ($s['status'] ?? '') === 'pending'
            ));
            $student['class_id']          = $classId;

            return $student;
        }, $students);

        return view('teacher.class', compact('class', 'students'));
    }

    public function showStudent(int $classId, int $studentId)
    {
        $studentResponse = $this->api()
            ->get("/api/classes/{$classId}/students/{$studentId}");

        if ($studentResponse->status() === 401) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        $student  = $studentResponse->json();
        $sessions = $this->api()->get("/api/students/{$studentId}/sessions")->json() ?? [];
        $stories  = $this->api()->get("/api/students/{$studentId}/stories")->json() ?? [];

        // Normalise score key for the chart and session cards
        $sessions = array_map(function ($session) {
            $session['accuracy_score'] = $session['accuracy_score']
                ?? $session['score']
                ?? null;
            return $session;
        }, $sessions);

        // Fetch parent class name for breadcrumb
        $classResponse = $this->api()->get("/api/classes/{$classId}");
        $class = $classResponse->successful() ? $classResponse->json() : ['name' => 'Class', 'id' => $classId];

        return view('teacher.student', compact(
            'student', 'sessions', 'stories', 'classId', 'class'
        ));
    }

    public function assignPassage(int $studentId, \Illuminate\Http\Request $request)
    {
        $request->validate(['passage' => 'required|string']);

        $this->api()->post("/api/students/{$studentId}/sessions", [
            'passage' => $request->passage,
        ]);

        return back()->with('success', 'Passage assigned successfully!');
    }

    public function approveSession(int $studentId, int $sessionId)
    {
        $response = $this->api()
            ->post("/api/students/{$studentId}/sessions/{$sessionId}/approve");

        if ($response->successful()) {
            return back()->with('approve_success', '🎉 Student leveled up!');
        }

        $message = $response->json('message') ?? 'Could not approve session.';
        return back()->with('approve_error', $message);
    }

    public function exportPdf(int $classId, int $studentId)
    {
        $student  = $this->api()
            ->get("/api/classes/{$classId}/students/{$studentId}")->json();
        $sessions = $this->api()
            ->get("/api/students/{$studentId}/sessions")->json() ?? [];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'teacher.student-pdf',
            compact('student', 'sessions')
        );

        return $pdf->download($student['name'] . '-reading-report.pdf');
    }
    
    public function allClasses()
    {
        $response = $this->api()->get('/api/classes');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $classes = $response->json() ?? [];
        return view('teacher.classes', compact('classes'));
    }

    public function reports()
    {
        $response = $this->api()->get('/api/classes');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired.']);
        }

        $classes = array_map(function ($basicClass) {
            $detail = $this->api()->get("/api/classes/{$basicClass['id']}")->json() ?? [];
            $class = array_merge($basicClass, $detail);

            $class['students'] = array_map(function ($student) use ($class) {
                $sessions = $this->api()
                    ->get("/api/students/{$student['id']}/sessions")
                    ->json() ?? [];

                $withScores = array_values(array_filter($sessions, fn($session) =>
                    !is_null($session['accuracy_score'] ?? $session['score'] ?? null)
                ));

                usort($withScores, fn($a, $b) =>
                    strtotime($b['updated_at'] ?? $b['created_at'] ?? 0)
                    - strtotime($a['updated_at'] ?? $a['created_at'] ?? 0)
                );

                $student['class_id'] = $class['id'];
                $student['sessions_count'] = count($sessions);
                $student['latest_score'] = $withScores[0]['accuracy_score'] ?? $withScores[0]['score'] ?? null;

                return $student;
            }, $class['students'] ?? []);

            return $class;
        }, $response->json() ?? []);

        return view('teacher.reports', compact('classes'));
    }

    public function analytics()
    {
        $response = $this->api()->get('/api/classes');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired.']);
        }

        $flatClasses = $response->json() ?? [];

        // Build analytics-ready class and session data shape expected by the view.
        $recentSessions = [];
        $classes = array_map(function ($basicClass) use (&$recentSessions) {
            $detail = $this->api()->get("/api/classes/{$basicClass['id']}")->json() ?? [];
            $class = array_merge($basicClass, $detail);

            $students = array_map(function ($student) use (&$recentSessions, $class) {
                $sessions = $this->api()
                    ->get("/api/students/{$student['id']}/sessions")
                    ->json() ?? [];

                $sessions = array_map(function ($session) use ($student, $class) {
                    $session['score'] = $session['score']
                        ?? $session['accuracy_score']
                        ?? null;
                    $session['student_id'] = $student['id'];
                    $session['student_name'] = $student['name'] ?? 'Student';
                    $session['class_id'] = $class['id'];
                    $session['class_name'] = $class['name'] ?? 'Class';
                    return $session;
                }, $sessions);

                $withScores = array_values(array_filter($sessions, fn($s) => !is_null($s['score'] ?? null)));
                usort($withScores, fn($a, $b) =>
                    strtotime($b['updated_at'] ?? $b['created_at'] ?? 0)
                    - strtotime($a['updated_at'] ?? $a['created_at'] ?? 0)
                );
                $student['latest_score'] = $withScores[0]['score'] ?? null;
                $student['sessions_count'] = count($sessions);

                $recentSessions = array_merge($recentSessions, $sessions);
                return $student;
            }, $class['students'] ?? []);

            $class['students'] = $students;
            return $class;
        }, $flatClasses);

        usort($recentSessions, fn($a, $b) =>
            strtotime($b['updated_at'] ?? 0) - strtotime($a['updated_at'] ?? 0)
        );

        return view('teacher.analytics', compact('classes', 'recentSessions'));
    }
    public function profile()
    {
        $user    = session('user');
        $classes = $this->api()->get('/api/classes')->json() ?? [];

        // Build stats
        $totalStudents = 0;
        $atRisk        = 0;

        foreach ($classes as $class) {
            $students = $class['students'] ?? [];
            $totalStudents += count($students);
            foreach ($students as $student) {
                $sessions = $this->api()->get("/api/students/{$student['id']}/sessions")->json() ?? [];
                $scores   = collect($sessions)->where('status', 'completed')->pluck('accuracy_score')->filter();
                if ($scores->count() > 0 && $scores->avg() < 60) {
                    $atRisk++;
                }
            }
        }

        return view('teacher.profile', compact('user', 'classes', 'totalStudents', 'atRisk'));
    }

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $request->validate(['name' => 'required|string', 'avatar' => 'nullable|string', 'email' => 'nullable|email']);

        $response = Http::withToken(session('api_token'))
            ->put(config('services.api.base_url') . '/api/profile/update', [
                'name'   => $request->name,
                'avatar' => $request->avatar,
                'email'  => $request->email,
            ]);

        if ($response->successful()) {
            $user           = session('user');
            $user['name']   = $request->name;
            $user['avatar'] = $request->avatar;
            $user['email']  = $request->email;
            session(['user' => $user]);
            return back()->with('success', 'Profile updated!');
        }

        return back()->withErrors(['name' => 'Failed to update profile.']);
    }

    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $response = Http::withToken(session('api_token'))
            ->put(config('services.api.base_url') . '/api/profile/password', [
                'current_password'      => $request->current_password,
                'password'              => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

        if ($response->successful()) {
            return back()->with('success', 'Password updated!');
        }

        return back()->withErrors(['current_password' => $response->json('message') ?? 'Failed to update password.']);
    }

    public function updatePhoto(\Illuminate\Http\Request $request)
    {
        // Auth check
        if (!session('user') || session('role') !== 'teacher') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = session('user');
        $userId = $user['id'] ?? time(); // Fallback if no id

        // Generate unique filename
        $file = $request->file('profile_photo');
        $timestamp = now()->format('YmdHis');
        $extension = $file->getClientOriginalExtension();
        $filename = "teacher-{$userId}-{$timestamp}.{$extension}";
        $path = $file->storeAs('avatars', $filename, 'public');

        // Update session immediately for instant UI refresh
        $user['avatar'] = $path;
        session(['user' => $user]);

        // Save avatar to database
        $authUser = Auth::user();
        if ($authUser) {
            $authUser->avatar = $path;
            $authUser->save();
        }

        // TODO: API Sync - Add when JWT backend supports photo upload
        // $this->api()->post('/api/profile/photo', ['avatar' => $path]);

        return response()->json([
            'success' => true,
            'avatar' => Storage::url($path), // Full URL e.g. /storage/avatars/...
            'path' => $path
        ]);
    }

    public function deleteAccount()
    {
        Http::withToken(session('api_token'))
            ->delete(config('services.api.base_url') . '/api/profile/delete');

        session()->flush();
        return redirect()->route('login')->with('message', 'Account deleted.');
    }

    public function storeClass(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'grade_level' => 'required|string',
        ]);

        $response = $this->api()->post('/api/classes', [
            'name'        => $request->name,
            'grade_level' => $request->grade_level,
        ]);

        if ($response->successful()) {
            return redirect()->route('teacher.classes')->with('success', 'Class created successfully!');
        }

        return back()->withErrors(['name' => $response->json('message') ?? 'Failed to create class.']);
    }

    public function generateSummary(int $classId, int $studentId)
    {
        $student  = $this->api()->get("/api/classes/{$classId}/students/{$studentId}")->json();
        $sessions = $this->api()->get("/api/students/{$studentId}/sessions")->json() ?? [];

        $sessions = array_map(function ($s) {
            $s['accuracy_score'] = $s['accuracy_score'] ?? $s['score'] ?? null;
            return $s;
        }, $sessions);

        $completed = array_filter($sessions, fn($s) => ($s['status'] ?? '') !== 'pending');
        $scores    = array_filter(array_column($completed, 'accuracy_score'));
        $avg       = count($scores) ? round(array_sum($scores) / count($scores)) : 0;
        $latest    = count($scores) ? end($scores) : null;
        $total     = count($completed);

        // Collect all error patterns
        $allErrors = [];
        foreach ($completed as $s) {
            $patterns = $s['error_patterns'] ?? [];
            if (is_string($patterns)) $patterns = json_decode($patterns, true) ?? [];
            foreach ($patterns as $w) $allErrors[] = $w;
        }
        $topErrors = array_slice(array_keys(array_count_values($allErrors)), 0, 5);

        // Try Anthropic API
        try {
            $apiKey = config('services.anthropic.key');

            if ($apiKey) {
                $prompt = "You are an educational assistant helping a Filipino elementary school teacher understand a student's reading progress.

        Student: {$student['name']}
        Grade: {$student['grade']}
        Reading Level: {$student['reading_level']}
        Total Sessions Completed: {$total}
        Average Accuracy: {$avg}%
        Latest Score: " . ($latest ?? 'N/A') . "%
        Most Missed Words: " . (count($topErrors) ? implode(', ', $topErrors) : 'none recorded') . "

        Write a concise 3-sentence progress summary for the teacher. Be encouraging but honest. Mention specific patterns if errors exist. End with one actionable recommendation.";

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'x-api-key'         => $apiKey,
                    'anthropic-version' => '2023-06-01',
                    'content-type'      => 'application/json',
                ])->post('https://api.anthropic.com/v1/messages', [
                    'model'      => 'claude-haiku-4-5-20251001',
                    'max_tokens' => 300,
                    'messages'   => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                ]);

                \Illuminate\Support\Facades\Log::info('Anthropic response', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                if ($response->successful()) {
                    $content = $response->json('content.0.text');
                    if ($content) {
                        return response()->json(['summary' => $content, 'source' => 'ai']);
                    }
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Anthropic error: ' . $e->getMessage());
        }

        // Rule-based fallback
        $trend = '';
        $scoreList = array_values($scores);
        if (count($scoreList) >= 2) {
            $first = $scoreList[0];
            $last  = end($scoreList);
            if ($last > $first)       $trend = "Performance is trending upward.";
            elseif ($last < $first)   $trend = "Performance has declined recently — additional support may be needed.";
            else                      $trend = "Performance has been consistent.";
        }

        $errorNote = count($topErrors)
            ? "Most frequently missed words include: " . implode(', ', $topErrors) . "."
            : "No significant error patterns recorded yet.";

        $recommendation = $avg >= 80
            ? "Recommend advancing to more challenging passages."
            : ($avg >= 60
                ? "Recommend continued practice with current level passages focusing on missed words."
                : "Recommend remedial reading sessions and one-on-one support.");

        $summary = "{$student['name']} has completed {$total} reading " . ($total === 1 ? "session" : "sessions") .
            " with an average accuracy of {$avg}%. {$trend} {$errorNote} {$recommendation}";

        return response()->json(['summary' => $summary, 'source' => 'fallback']);
    }
}

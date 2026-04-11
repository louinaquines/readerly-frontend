<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    private function api(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withToken(session('api_token'))
            ->baseUrl(config('services.api.base_url'));
    }

    public function dashboard()
    {
        $user     = session('user');

        $studentResponse = $this->api()->get("/api/students/by-user/{$user['id']}");

        if ($studentResponse->failed()) {
            return view('student.dashboard', [
                'user'     => $user,
                'student'  => null,
                'stories'  => [],
                'sessions' => [],
            ]);
        }

        $student  = $studentResponse->json();

        $stories  = $this->api()->get("/api/students/{$student['id']}/stories")->json();
        $sessions = $this->api()->get("/api/students/{$student['id']}/sessions")->json();

        $sessions = is_array($sessions) && isset($sessions[0]) ? $sessions : [];
        $stories  = is_array($stories) && isset($stories[0]) ? $stories : [];

        $user['reading_level'] = $student['reading_level'] ?? 1;

        $student = $this->api()->get("/api/students/{$user['id']}")->json() ?? [];
        return view('student.dashboard', compact('stories', 'sessions', 'user', 'student'));
    }
    public function profile()
    {
        $user     = session('user');
        $student  = $this->api()->get("/api/students/by-user/{$user['id']}")->json();
        $sessions = [];
        $stories  = [];

        if (isset($student['id'])) {
            $sessions = $this->api()->get("/api/students/{$student['id']}/sessions")->json() ?? [];
            $stories  = $this->api()->get("/api/students/{$student['id']}/stories")->json() ?? [];
        }

        $sessions = is_array($sessions) ? array_filter($sessions, fn($s) => is_array($s)) : [];
        $stories  = is_array($stories) ? array_filter($stories, fn($s) => is_array($s)) : [];

        $totalRead    = count(array_filter($sessions, fn($s) => ($s['status'] ?? '') !== 'pending'));
        $avgAccuracy  = collect($sessions)->where('status', 'completed')->avg('accuracy_score') ?? 0;

        return view('student.profile', compact('user', 'student', 'sessions', 'stories', 'totalRead', 'avgAccuracy'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate(['name' => 'required|string', 'avatar' => 'nullable|string']);

        $token = session('api_token');
        if (!$token) {
            \Illuminate\Support\Facades\Log::error('No api_token in session');
            return back()->withErrors(['name' => 'Not authenticated. Please log in again.']);
        }

        $user = session('user');
        $student = $this->api()->get("/api/students/by-user/{$user['id']}")->json();
        $studentId = $student['id'] ?? null;

        $baseUrl = config('services.api.base_url');
        
        // Try student-specific endpoint first, fallback to generic
        $endpoints = [];
        if ($studentId) {
            $endpoints[] = $baseUrl . "/api/students/{$studentId}/profile";
        }
        $endpoints[] = $baseUrl . '/api/profile/update';

        foreach ($endpoints as $url) {
            $response = \Illuminate\Support\Facades\Http::withToken($token)
                ->put($url, [
                    'name'   => $request->name,
                    'avatar' => $request->avatar,
                ]);

            \Illuminate\Support\Facades\Log::info('Profile update attempt', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                $user['name']   = $request->name;
                $user['avatar'] = $request->avatar;
                session(['user' => $user]);
                return back()->with('success', 'Profile updated!');
            }
        }

        return back()->withErrors(['name' => 'Failed to update profile.']);
    }

    public function updatePhoto(Request $request)
    {
        // Auth check
        if (!session('user')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = session('user');
        $userId = $user['id'] ?? time(); // Fallback if no id

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->file('profile_photo');
        $timestamp = now()->format('YmdHis');
        $extension = $file->getClientOriginalExtension();
        $filename = "student-{$userId}-{$timestamp}.{$extension}";
        $path = $file->storeAs('avatars', $filename, 'public');

        // Update session immediately for instant UI refresh
        $user['avatar'] = $path;
        session(['user' => $user]);

        return response()->json([
            'success' => true,
            'avatar' => Storage::url($path),
            'path' => $path
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $response = \Illuminate\Support\Facades\Http::withToken(session('api_token'))
            ->put(config('services.api.base_url') . '/api/profile/password', [
                'current_password'      => $request->current_password,
                'password'              => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

        if ($response->successful()) {
            return back()->with('success', 'Password updated!');
        }

        return back()->withErrors(['current_password' => $response->json('message') ?? 'Failed.']);
    }

    public function deleteAccount()
    {
        \Illuminate\Support\Facades\Http::withToken(session('api_token'))
            ->delete(config('services.api.base_url') . '/api/profile/delete');

        session()->flush();
        return redirect()->route('login');
    }
}
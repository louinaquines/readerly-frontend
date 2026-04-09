<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class StudentReaderController extends Controller
{
    public function show(int $studentId, int $sessionId)
    {
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Session expired. Please login again.']);
        }

        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . "/api/students/{$studentId}/sessions/{$sessionId}");

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login')
                ->withErrors(['email' => 'Session expired. Please login again.']);
        }

        if (!$response->successful()) {
            return redirect()->route('student.dashboard')
                ->withErrors(['error' => 'Could not load reading session.']);
        }

        $session = $response->json();

        return view('reader', [
            'studentId' => $studentId,
            'sessionId' => $sessionId,
            'passage'   => $session['passage'] ?? '',
        ]);
    }
}
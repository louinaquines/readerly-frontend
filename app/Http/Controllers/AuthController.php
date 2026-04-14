<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request, ApiService $api)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $response = $api->login($request->email, $request->password);

        if (!isset($response['access_token'])) {
            return back()->withErrors(['email' => $response['message'] ?? 'Invalid credentials.']);
        }

        $user = $response['user'] ?? ['email' => $request->email];
        $role = $user['role'] ?? 'student';

        session([
            'api_token' => $response['access_token'],
            'user'      => $user,
            'role'      => $role,
        ]);

        return redirect()->route($role . '.dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request, ApiService $api)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
            'role'                  => 'required|in:teacher,student',
        ]);

        $response = $api->register([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'role'                  => $request->role,
        ]);

        // Registration failed — show error from API
        if (!isset($response['access_token'])) {
            $message = $response['message']
                ?? collect($response['errors'] ?? [])->flatten()->first()
                ?? 'Registration failed. Please try again.';
            return back()->withErrors(['email' => $message])->withInput();
        }

        $user = $response['user'] ?? [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];
        $role = $user['role'] ?? $request->role;

        session()->flash('just_registered', true);
        return redirect()->route('login');
    }

    public function logout()
    {
        $user = session('user');

        // Delete profile photo if exists
        if (isset($user['avatar']) && $user['avatar']) {
            $filePath = storage_path('app/public/' . $user['avatar']);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        \Illuminate\Support\Facades\Http::withToken(session('api_token'))
            ->post(config('services.api.base_url') . '/api/auth/logout');

        session()->flush();
        return redirect()->route('login');
    }
}
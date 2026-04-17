<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        $dbUser = User::where('email', $request->email)->first();
        $user['member_id'] = $dbUser->member_id
            ?? $this->formatMemberId($role, (int) ($user['id'] ?? 0));
        if ($dbUser && $dbUser->avatar) {
            $user['avatar'] = $dbUser->avatar;
        }
        $this->upsertLocalUser($user, $role);

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

        $generatedMemberId = $this->nextMemberId($request->role);

        $response = $api->register([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'role'                  => $request->role,
            // API expects student_id for student registration.
            'student_id'            => $request->role === 'student' ? $generatedMemberId : null,
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
        $user['member_id'] = $generatedMemberId;

        $this->upsertLocalUser($user, $role, $request->password);

        session()->flash('just_registered', true);
        return redirect()->route('login');
    }

    private function nextMemberId(string $role): string
    {
        $prefix = $role === 'teacher' ? 'tch-' : 'stu-';

        $last = User::where('role', $role)
            ->whereNotNull('member_id')
            ->orderByDesc('id')
            ->value('member_id');

        $nextNumber = 1;
        if (is_string($last) && preg_match('/(\d+)$/', $last, $matches)) {
            $nextNumber = ((int) $matches[1]) + 1;
        }

        return $prefix . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    private function formatMemberId(string $role, int $id): string
    {
        $prefix = $role === 'teacher' ? 'tch-' : 'stu-';
        $num = $id > 0 ? $id : 1;
        return $prefix . str_pad((string) $num, 4, '0', STR_PAD_LEFT);
    }

    private function upsertLocalUser(array $user, string $role, ?string $plainPassword = null): void
    {
        $email = $user['email'] ?? null;
        if (!$email) {
            return;
        }

        $existing = User::where('email', $email)->first();
        $memberId = $user['member_id']
            ?? ($existing->member_id ?? $this->formatMemberId($role, (int) ($user['id'] ?? 0)));

        $attributes = [
            'name'      => $user['name'] ?? ($existing->name ?? ''),
            'role'      => $role,
            'member_id' => $memberId,
            'avatar'    => $user['avatar'] ?? ($existing->avatar ?? null),
        ];

        if ($plainPassword !== null) {
            $attributes['password'] = Hash::make($plainPassword);
        } elseif (!$existing) {
            $attributes['password'] = Hash::make(Str::random(32));
        }

        User::updateOrCreate(['email' => $email], $attributes);
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
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request via API.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $apiUrl = config('services.api.url', 'http://localhost:8081/api');

        $response = Http::acceptJson()->post("{$apiUrl}/login", [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        if (! $response->successful()) {
            $errorMessage = $response->json('message') ?? 'Email atau password yang Anda masukkan salah.';

            return back()->withErrors([
                'email' => $errorMessage,
            ])->onlyInput('email');
        }

        $tokenData = $response->json();

        session([
            'access_token' => $tokenData['access_token'] ?? null,
            'refresh_token' => $tokenData['refresh_token'] ?? null,
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user && ! empty($tokenData['access_token'])) {
            $userResponse = Http::withToken($tokenData['access_token'])
                ->acceptJson()
                ->get("{$apiUrl}/user");

            if ($userResponse->successful()) {
                $userData = $userResponse->json();
                $user = User::firstOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'] ?? 'User',
                        'password' => bcrypt(str()->random(16)),
                    ]
                );
            }
        }

        if ($user) {
            $remember = $request->boolean('remember');
            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Gagal mengautentikasi pengguna.',
        ])->onlyInput('email');
    }

    /**
     * Refresh session access and refresh tokens via API.
     */
    public function refreshToken(Request $request): JsonResponse|RedirectResponse
    {
        $refreshToken = session('refresh_token');

        if (! $refreshToken) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Refresh token tidak ditemukan.'], 401);
            }

            return redirect()->route('login')->withErrors(['email' => 'Sesi Anda telah berakhir, silakan login kembali.']);
        }

        $apiUrl = config('services.api.url', 'http://localhost:8081/api');

        $response = Http::withToken($refreshToken)
            ->acceptJson()
            ->post("{$apiUrl}/refresh");

        if ($response->successful()) {
            $tokenData = $response->json();

            session([
                'access_token' => $tokenData['access_token'] ?? session('access_token'),
                'refresh_token' => $tokenData['refresh_token'] ?? $refreshToken,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Token berhasil diperbarui.',
                    'access_token' => session('access_token'),
                ]);
            }

            return back()->with('status', 'Token berhasil diperbarui.');
        }

        session()->forget(['access_token', 'refresh_token']);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Gagal memperbarui token.'], 401);
        }

        return redirect()->route('login')->withErrors(['email' => 'Sesi Anda telah berakhir, silakan login kembali.']);
    }

    /**
     * Destroy an authenticated session via API.
     */
    public function logout(Request $request): RedirectResponse
    {
        $accessToken = session('access_token');
        $apiUrl = config('services.api.url', 'http://localhost:8081/api');

        if ($accessToken) {
            Http::withToken($accessToken)
                ->acceptJson()
                ->post("{$apiUrl}/logout");
        }

        session()->forget(['access_token', 'refresh_token']);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil keluar dari sistem.');
    }
}


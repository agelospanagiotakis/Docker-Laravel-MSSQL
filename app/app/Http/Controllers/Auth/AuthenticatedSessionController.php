<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
// use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
        $request->validate([
            'userid' => ['required'],
            'password' => ['required'],
        ]);
        
        // Debug: Log input values
        \Log::info('Request Data:', $request->all());
        \Log::info('Login attempt:', ['userid' => $request->input('userid')]);
        // dd($request->input('userId'));
        // die;
        // Use custom logic for authentication
        $user = User::where('UserID', $request->input('userid'))->first();
        // var_dump( $user);
        // die;

        if (!$user) {
            // Debug: Log if user is not found
            \Log::info('User not found for UserID:', ['userid' => $request->input('userid')]);
            return back()->withErrors([
                'userid' => 'The provided user id does not match our records.',
            ]);
        }
        if ($request->input('password') == $user->Password) {
            // Debug: Log successful login
            \Log::info('Login successful for UserID:', ['userid' => $request->input('userid')]);

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
        \Log::info('Password check failed for UserID:', ['userid' => $request->input('userid')]);


        return back()->withErrors([
            'userid' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function redirectByRole()
    {
        $user = Auth::user();

        // Admin (role_id = 1) va al panel admin
        if ($user->role_id == 1) {
            return redirect()->route('admin.dashboard');
        }

        // Estilista (role_id = 2) va al panel estilista
        if ($user->role_id == 2) {
            return redirect()->route('stylist.dashboard');
        }

        // Cliente u otros van al home
        return redirect()->route('home');
    }
}

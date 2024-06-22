<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use SendsPasswordResetEmails; // Utilisation du trait pour l'envoi d'emails de réinitialisation de mot de passe

    public function showLoginForm()
    {
        return view('notes.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (!$user->is_approved) {
                Auth::logout();
                return redirect()->route('login')->with('message', 'Thank you for creating an account. Your account is currently under review. You will receive an email once your account is approved.');
            }

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return $this->authenticated($request, $user);
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/profile/' . $user->id);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}

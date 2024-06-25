<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login'; // Redirection après réinitialisation du mot de passe

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Affiche le formulaire de réinitialisation de mot de passe avec le token
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Réinitialise le mot de passe
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // Gestion de la réponse en fonction du résultat de la réinitialisation
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    // Redirection après une réinitialisation réussie
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())
                    ->with('status', trans($response));
    }

    // Redirection en cas d'échec de la réinitialisation
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
    }
}
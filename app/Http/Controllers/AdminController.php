<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApproved;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Middleware pour vérifier si l'utilisateur est administrateur
    }

    public function dashboard()
    {
        // Obtenir les utilisateurs et les notes non approuvés
        $unapprovedUsers = User::where('is_approved', false)->get();
        $unapprovedNotes = Note::where('is_approved', false)->get();

        return view('admin.dashboard', compact('unapprovedUsers', 'unapprovedNotes'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        // Envoi d'un email de notification à l'utilisateur
        Mail::to($user->email)->send(new UserApproved($user));

        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur approuvé avec succès.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function approveNote($id)
    {
        $note = Note::findOrFail($id);
        $note->is_approved = true;
        $note->save();
        return redirect()->route('admin.dashboard')->with('success', 'Note approuvée avec succès.');
    }

    public function deleteNote($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Note supprimée avec succès.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Rediriger vers la page de connexion après déconnexion
    }
}

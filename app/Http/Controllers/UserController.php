<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Note;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{

    public function redirectTest()
    {
        return redirect()->route('notes.register')->with('success', 'test');
    }
    

    public function showRegistrationForm()
    {
        return view('notes.register-user');
    }
    public function register(Request $request)
    {

        try {

              // Valider les données du formulaire
        $request->validate([
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'university' => 'nullable|string|max:255',
            'study_field' => 'nullable|string|max:255',
            'study_level' => 'nullable|string|max:255',
            //'coordinates' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            //'pays' => 'nullable|string|max:255',
            //'city' => 'nullable|string|max:255',
        ]);
        // Ajoutez cette ligne pour afficher les données du formulaire
        //dd($request->all());

        // Créer un nouvel utilisateur
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->family_name = $request->input('family_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->university = $request->input('university');
        $user->study_field = $request->input('study_field');
        $user->study_level = $request->input('study_level');
        //$user->coordinates = $request->input('coordinates');
        $user->phone = $request->input('phone');
        //$user->pays = $request->input('pays');
        //$user->city = $request->input('city');
        
        // Enregistrer l'utilisateur dans la base de données
        $user->save();

        // Rediriger l'utilisateur après l'inscription
        return redirect()->route('notes.login', ['id' => $user->id])->with('success', 'Registration successful. Please login.');
          
          } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->route('notes.register')->with('error',"Registration Failed. $errorMessage");
          }


      
    }

    public function displayUser($id)
    {
        $user = User::find($id);
        return view('notes.display-user', compact('user'));
        // Vérifiez si l'utilisateur est authentifié
        /*if (Auth::check()) {
            // Récupérez l'utilisateur actuellement authentifié
            $user = Auth::user();
            
            // Affichez la vue du profil de l'utilisateur avec les données de l'utilisateur
            return view('notes.display-user', compact('user'));
        } else {
            return view('notes.register-user');
        } */
    }
  
    public function edit(Request $request): View
    {
        return view('notes.display-user', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('notes.display-user')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    // UserController.php

public function showUserProfile($id)
{
    $user = User::findOrFail($id);
    $notes = Note::where('ID_utilisateur', $id)->orderBy('published_at', 'desc')->get();
    
    return view('notes.user-profile', compact('user', 'notes'));
}

    
}
<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Note;


use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /*public function store(Request $request, string $noteId)
{  
    
     // Valider les données du formulaire
    $request->validate([
        'comment' => 'required|string',
    ]);

    // Créer un nouveau commentaire
    $commentaire = new Commentaire();
    $commentaire->ID_note = $noteId; // Remplacez 1 par l'ID de la note à laquelle le commentaire est associé
    $commentaire->Contenu = $request->input('Contenu');
    $commentaire->Date = now();
    $commentaire->ID_utilisateur = 1; // Remplacez 1 par l'ID de l'utilisateur qui a fait le commentaire
    $commentaire->rating = $request->input('rating'); // Note par défaut
    $commentaire->save();

    // Redirection avec un message de succès
    return redirect()->back()->with('success', 'Commentaire ajouté avec succès!');
}*/
public function getComments(Note $note)
{
    // Récupérer les commentaires pour la note spécifique
    // Récupérer les commentaires pour la note spécifique avec les utilisateurs associés
    $comments = Commentaire::where('ID_note', $note->id)->with('utilisateur')->get();

    // Retourner la vue avec les commentaires
    return view('comments', compact('comments'));
}
public function store(Request $request, $id){
    $commentaire = new Commentaire();
    $commentaire->ID_note = $id;
    $commentaire->Contenu = $request->get('Contenu');
    $commentaire->Date = now();
    $commentaire->ID_utilisateur = auth()->user()->id; // Remplacez 1 par l'ID de l'utilisateur qui a fait le commentaire
    $commentaire->rating = 0; // Note par défaut
    $commentaire->save();

    // Redirection avec un message de succès
    return redirect()->route('notes.detail', ['id' => $id])->with('success', 'Commentaire ajouté avec succès!');
}
}
<?php

namespace App\Http\Controllers;

use App\Models\SavedNote;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedNoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $savedNotes = SavedNote::where('user_id', $user->id)->with('note')->get();

        return view('notes.display-user', compact('user', 'savedNotes'));
    }

    public function save(Request $request, $id)
    {
        $user = Auth::user();
        $note = Note::find($id);

        if ($note) {
            // Vérifier si la note est déjà sauvegardée par l'utilisateur
            $existingSavedNote = SavedNote::where('user_id', $user->id)
                                          ->where('note_id', $note->id)
                                          ->first();
                                          
            if (!$existingSavedNote) {
                SavedNote::create([
                    'user_id' => $user->id,
                    'note_id' => $note->id
                ]);

                return redirect()->back()->with('success', 'Note saved successfully!');
            }

            return redirect()->back()->with('info', 'You have already saved this note!');
        }

        return redirect()->back()->with('error', 'Note not found!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $savedNote = SavedNote::where('user_id', $user->id)->where('note_id', $id)->first();

        if ($savedNote) {
            $savedNote->delete();

            return redirect()->back()->with('success', 'Note removed successfully!');
        }

        return redirect()->back()->with('error', 'Saved note not found!');
    }
}
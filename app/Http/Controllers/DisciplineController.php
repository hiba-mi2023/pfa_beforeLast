<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $disciplines = Discipline::all();
        return view('notes.add-note', ['disciplines' => $disciplines]);
    }

    public function create()
    {
        return view('disciplines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Discipline::create([
            'name' => $request->name,
        ]);

        return redirect()->route('disciplines.index');
    }

    public function show(Discipline $discipline)
    {
        return view('disciplines.show', ['discipline' => $discipline]);
    }

    public function edit(Discipline $discipline)
    {
        return view('disciplines.edit', ['discipline' => $discipline]);
    }

    public function update(Request $request, Discipline $discipline)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $discipline->update([
            'name' => $request->name,
        ]);

        return redirect()->route('disciplines.index');
    }

    public function destroy(Discipline $discipline)
    {
        $discipline->delete();

        return redirect()->route('disciplines.index');
    }
}
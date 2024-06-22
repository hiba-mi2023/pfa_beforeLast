<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::orderBy('name', 'asc')->get();

        return view('topics.index', ['topics' => $topics]);
    }

    public function create()
    {
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discipline' => 'required|string|max:255',
        ]);

        Topic::create([
            'name' => $request->name,
            'discipline' => $request->discipline,
        ]);

        return redirect()->route('topics.index');
    }

    public function show(Topic $topic)
    {
        return view('topics.show', ['topic' => $topic]);
    }

    public function edit(Topic $topic)
    {
        return view('topics.edit', ['topic' => $topic]);
    }

    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discipline' => 'required|string|max:255',
        ]);

        $topic->update([
            'name' => $request->name,
            'discipline' => $request->discipline,
        ]);

        return redirect()->route('topics.index');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index');
    }
}
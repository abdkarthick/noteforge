<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        Note::create($request->only('title', 'body'));

        return redirect()->route('notes.index');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q', '');
        $notes = Note::where('title', 'like', "%{$keyword}%")
            ->orWhere('body', 'like', "%{$keyword}%")
            ->latest()
            ->get();

        return view('notes.index', compact('notes'));
    }
}

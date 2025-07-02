<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return response()->json([
            'status' => 1,
            'message' => 'Notes retrieved successfully',
            'data' => $notes
        ]);
    }

    public function create()
    {
        return response()->json([
            'status' => 1,
            'message' => 'Note creation form',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = Note::create($request->all());
        return response()->json([
            'status' => 1,
            'message' => 'Note created successfully',
            'data' => $note
        ], 201);
    }

    public function show(Note $note)
    {
        return response()->json([
            'status' => 1,
            'message' => 'Note retrieved successfully',
            'data' => $note
        ]);
    }

    public function edit(Note $note)
    {
        return response()->json([
            'status' => 1,
            'message' => 'Note data for editing',
            'data' => $note
        ]);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note->update($request->all());
        return response()->json([
            'status' => 1,
            'message' => 'Note updated successfully',
            'data' => $note
        ]);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Note deleted successfully'
        ]);
    }
}


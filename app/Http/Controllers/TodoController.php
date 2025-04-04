<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json([
            'data' => $todos
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'min:3|required'
        ]);

        $todos = Todo::create(['task' => $request->task]);
        return response()->json([
            'data' => $todos
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $todos = Todo::find($id)->first();
        return response()->json([
            'data' => $todos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'min:3|required'
        ]);

        $todos = Todo::find($id);
        $todos->update(['task' => $request->task]);
        return response()->json([
            'data' => $todos
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return response()->json([
            'message' => 'success'
        ] ,200);
    }

    public function markIsComplete($id)
    {
        Todo::find($id)->update(['isComplete' => true]);
        return response()->json(['message' => 'success'], 200);
    }

    public function markIsUncompleted($id)
    {
        Todo::find($id)->update(['isComplete' => false]);
        return response()->json(['message' => 'success'], 200);
    }

    public function search($param) {
        $todos = Todo::where('task', 'like', "%$param%")->get();
        return response()->json([
            'data' => $todos
        ]);
    }
}

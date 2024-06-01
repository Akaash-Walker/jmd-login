<?php

namespace App\Http\Controllers;

use App\Models\JeffToDo;
use Illuminate\Http\Request;

class JeffToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = JeffToDo::all();

        return view('jeff_todo.index', ['todos' => $todos]);
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
        $todo = new JeffToDo;

        $todo->name = $request->name;

        $todo->save();

        return redirect(route('jeff-todo.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JeffToDo $jeffToDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JeffToDo $jeffToDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JeffToDo $jeffToDo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JeffToDo $jeff_todo)
    {
        $jeff_todo->delete();

        return redirect(route('jeff-todo.index'));
    }
}

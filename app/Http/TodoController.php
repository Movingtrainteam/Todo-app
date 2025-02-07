<?php

namespace App\Http\Controllers;

use App\Models\Todo; // Import the Todo model
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public  unction index()
    {
        // Fetch all todos, but default to an empty collection if no todos are found
        $todos = Todo::all() ?: collect(); // If Todo::all() returns null, use an empty collection
        dd($todos); // Dump and Die statement to check the contents of $todos
        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function show($id)
    {
        return $id;
    }
}

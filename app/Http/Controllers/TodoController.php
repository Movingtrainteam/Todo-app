<?php

namespace App\Http\Controllers;

use App\Models\Todo; // Import the Todo model
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        // Fetch paginated todos, 6 per page
        $todos = Todo::paginate(6);
        return view('todos.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_completed' => 'boolean',
        ]);

        // Create a new Todo
        Todo::create($validated);

        // Redirect back to the todos index with a success message
        return redirect()->route('todos.index')->with('alert-success', 'Todo created successfully!');
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        if (!$todo) {
            request()->session()->flash('error','Todo not found');
            return to_route('todos.index')->withErrors([
                'error' => 'Unable to locate Todo'
            ]);
        }

        return view('todos.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        if (!$todo) {
            request()->session()->flash('error','Todo not found');
            return to_route('todos.index')->withErrors([
                'error' => 'Unable to locate Todo'
            ]);
        }

        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(Request $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo) {
            request()->session()->flash('error','Todo not found');
            return to_route('todos.index')->withErrors([
                'error' => 'Unable to locate Todo'
            ]);
        }

        $todo->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'is_completed'=> $request->is_completed,
        ]);

        request()->session()->flash('alert-info','Todo updated successfully');
        return redirect()->route('todos.index')->with('alert-success', 'Todo updated successfully!');
    }

    public function destroy(Request $request)
    {
        $todo = Todo::find($request->id); // Retrieve the ID from the request query parameter
        if (!$todo) {
            request()->session()->flash('error', 'Todo not found');
            return to_route('todos.index')->withErrors([
                'error' => 'Unable to locate Todo'
            ]);
        }

        $todo->delete(); // Delete the todo
        request()->session()->flash('alert-success', 'Todo deleted successfully');
        return redirect()->route('todos.index');
    }

    public function confirmDelete($id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.confirm-delete', ['todo' => $todo]);
    }


}

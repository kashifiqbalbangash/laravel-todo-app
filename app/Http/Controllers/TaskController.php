<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks
    public function index()
    {
        // $tasks = Task::latest()->get();
        $tasks = Task::latest()->paginate(3); // paginations
        return view('tasks.index', compact('tasks'));
    }

    // Show form to create task
    public function create()
    {
        return view('tasks.create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show form to edit task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function toggleComplete(Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated.');
    }

}

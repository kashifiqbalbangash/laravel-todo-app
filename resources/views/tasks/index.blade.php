@extends('layouts.app')

@section('content')
    <h1>Task List</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Completed?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <!-- <td>{{ $task->is_completed ? 'Yes' : 'No' }}</td> -->
                <td>
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                    </form>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $tasks->links() }}
    </div>


    @else
        <p>No tasks found. Create one!</p>
    @endif
@endsection

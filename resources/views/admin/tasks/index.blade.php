@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin - Tasks</h1>
    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    @if ($tasks->count())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th> 
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $index => $task)
                        <tr>
                            <td>{{ $tasks->firstItem() + $index }}</td> 
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }} 
        </div>
    @else
        <p>No tasks available.</p>
    @endif
</div>
@endsection

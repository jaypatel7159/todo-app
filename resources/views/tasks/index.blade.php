@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks</h1>

    @if (Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
    @endif

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
                                <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @elseif ($task->user_id === Auth::id())
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
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

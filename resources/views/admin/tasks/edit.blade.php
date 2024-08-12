@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="incomplete" {{ old('status', $task->status) == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Complete</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

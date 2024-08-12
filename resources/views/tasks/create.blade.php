@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
        @csrf
        @if(isset($task))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $task->title ?? '') }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status" id="status_incomplete" value="incomplete" {{ old('status', $task->status ?? '') === 'incomplete' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_incomplete">Incomplete</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status" id="status_completed" value="completed" {{ old('status', $task->status ?? '') === 'completed' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_completed">Completed</label>
            </div>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection

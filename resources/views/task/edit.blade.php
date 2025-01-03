@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">Back</a>
        <h1>Edit </h1>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="task_name"></label>
                <select class="form-select" name="user_id" id="user_id" required>
                    <option>Select User Name</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($task->user_id == $user->id) ? 'selected' : '' }} >{{ $user->name }}</option>
                        @endforeach 
                  </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" id="task_name" class="form-control @error('task_name') is-invalid @enderror" value="{{ old('task_name', $task->task_name) }}" required>
                @error('task_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
@endsection
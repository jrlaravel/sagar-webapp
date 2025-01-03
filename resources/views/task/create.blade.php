
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <h1>Create New</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="task_name"></label>
                <select class="form-select" name="user_id" id="user_id" required>
                    <option>Select User Name</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach 
                  </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" id="task_name" class="form-control @error('task_name') is-invalid @enderror" value="{{ old('task_name') }}" required>
                @error('task_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
    </div>
@endsection
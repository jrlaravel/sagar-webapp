
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

        <h1>Create Follow Up</h1>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="task_id" value="{{ $task->id }}" />
            <input type="hidden" name="user_id" value="{{ $task->user_id }}" />

            <div class="form-group">
                <label for="title">follow Name</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
    </div>
@endsection
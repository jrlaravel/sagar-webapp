
@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.list') }}" class="btn btn-primary mb-3">Back</a>
        <div class="row justify-content-center">

        <h1>Create User</h1>

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
    </div>
@endsection
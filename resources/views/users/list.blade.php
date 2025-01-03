@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Create User</a>
    <div class="row justify-content-center">
        <h4>User List</h4>
        <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
              <tr>
                <th>Task</th>
                <th>User Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>
                        @if($task->status == '1')
                        <a href="{{ route('tasks.status', $task->id) }}" class="btn btn-success btn-sm">Complete</a>
                        @else
                        <a href="{{ route('tasks.status', $task->id) }}" class="btn btn-danger btn-sm">Incomplete</a>
                        @endif 
                    </td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm">view</a>
                        @if($task->status != '1')
                          <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>
                        @endif
                    </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

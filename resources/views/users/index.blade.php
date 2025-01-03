@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
              <tr>
                <th>Task</th>
                <th>user Name</th>
                <th>Follow-ups</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>
                        <a href="{{ route('follow.create', $task->id) }}" class="btn btn-warning btn-sm">Add Follow</a>
                    </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

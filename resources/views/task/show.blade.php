@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">back</a>
    <h4 class="text-danger">{{ $task->task_name }}</h4>
    <div class="row justify-content-center">
        
        <table class="table">
            <thead>
              <tr>
                <th>followup</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($followups as $followup)
                <tr>
                    <td>{{ $followup->title }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

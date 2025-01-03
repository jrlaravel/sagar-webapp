<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Followups;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', '0')->get();
        $tasks = Task::with('user')->get();

        return view('task.index', compact('users', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_admin', '0')->get();
        return view('task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'user_id' => 'required',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'tasks created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $followups = Followups::where('task_id', $task->id)->get();
        
        return view('task.show', compact('task','followups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::where('is_admin', '0')->get();
        return view('task.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'user_id' => 'required',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'tasks updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect()->route('tasks.index')->with('success', 'tasks deleted successfully!');
    }
    
    public function status($task_id)
    {
        $task = Task::where('id', $task_id)->first();
        
        if (!$task) {
            abort(404);
        }

        $task->status =!$task->status;
        $task->save();
        
        return redirect()->route('tasks.index')->with('success', 'tasks status  successfully!');
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Followups;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $is_admin = \Auth::user()->is_admin;

        if($is_admin != '1') {
            $tasks = Task::with('user')
                ->where('user_id', \Auth::user()->id)
                ->where('status', '0')
                ->get();

            return view('users.index', compact('tasks'));
        }
        
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($task_id)
    {
        
        $task = Task::where('user_id', \Auth::user()->id)->where('id', $task_id)->first();
     
        if (!$task) {
            abort(404);
        }

        return view('users.create', compact('task'));
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
            'title' => 'required|string|max:255',
            'task_id' => 'required',
            'user_id' => 'required',
        ]);

        $task = Task::where('user_id', \Auth::user()->id)->where('id', $request->task_id)->first();
     
        if (!$task) {
            abort(404);
        }


        Followups::create($validated);
        
        return redirect()->route('home')->with('success', 'Follow ups created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

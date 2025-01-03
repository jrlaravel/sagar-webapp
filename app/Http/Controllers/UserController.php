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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $saveUser = new User();
        $saveUser->name = $request->name;
        $saveUser->email = $request->email;
        $saveUser->password = \Hash::make($request->password);
        $saveUser->save();

        return redirect()->route('user.list')->with('success', 'user created successfully!');
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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.list')->with('success', 'user update successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.list')->with('success', 'user delete successfully!');
    }

    public function taskList()
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
    
    public function followCreate($task_id)
    {
        $task = Task::where('user_id', \Auth::user()->id)->where('id', $task_id)->first();
     
        if (!$task) {
            abort(404);
        }

        return view('users.follow-add', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function followStore(Request $request)
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

}

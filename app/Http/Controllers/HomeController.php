<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    function tasks(){
        $tasks = Task::all();
        return view('home.tasks', compact('tasks'));
    }

    function store(Request $request){
        request()->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        Task::create(request()->only('name', 'description'));

        return back();
    }

    function taskEdit(){
        $tasks = Task::all();
        return view('home.edit', compact('tasks'));
    }

    function editStore(Request $request){
        Task::find($request->id)->update(request()->only('name', 'description'));

        return redirect('/tasks');
    }

    function deleteTask($id){
        Task::find($id)->delete();
        return redirect('/tasls');
    }
}

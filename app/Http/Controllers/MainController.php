<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class MainController extends Controller
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
        return redirect('/tasks');
    }

    // function toggleTas($id){
    function toggleTask(Task $task){
        // $task = Task::first();
        // if($task->is_done == 0){
        //     Task::findOrFail($id)->update([
        //         'is_done' => 1,
        //     ]);
        // }else{
        //     Task::findOrFail($id)->update([
        //         'is_done' => 0,
        //     ]);
        // }

        // return back();

        // DILAKUKAN REFACTORING UNTUK MEMPERSINGKAT
        // toggleStatus() berada pada file Models
        $task->toggleStatus();

        return back();
    }
}

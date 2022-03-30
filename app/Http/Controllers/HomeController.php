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
        Task::create(request()->only('name', 'description'));

        return back();
    }
}

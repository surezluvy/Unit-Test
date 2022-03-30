<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    function tasks(){
        return view('home.tasks');
    }

    function store(Request $request){
        dd($request->description, "test");
        Task::create(request()->only('name', 'description'));
    }
}

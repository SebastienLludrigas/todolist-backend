<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use GrahamCampbell\ResultType\Result;

class MainController extends Controller
{
    public function home()
    {
        $category = Category::find(3);

        $tasks = Task::with('category')->get();

        foreach($tasks as $task) {
            dump($task->category);
        }

        return view('greeting', ['name' => 'Robert']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request as Req;
use Inertia\Inertia;

class TasksController extends Controller
{
    public function index()
    {

        $tasks = Auth::user()->tasks;
        $tasks = $tasks->sortByDesc('id')->values();

        return Inertia::render('Dashboard', [
            'tasks' => $tasks
        ]);
    }

    public function store()
    {
        Auth::user()->tasks()->create(
            Request::validate([
                'text' => ['required', 'min:3']
            ])
        );

        return Redirect::route('todo.index');
    }

    public function update(Task $task, Req $request)
    {
        if ($task->user_id == Auth::user()->id) {
            $task->update(
                Request::validate([
                    'id' => ['required'],
                    'is_done' => ['required']
                ])
            );
        }

        return Redirect::route('todo.index');
    }
}

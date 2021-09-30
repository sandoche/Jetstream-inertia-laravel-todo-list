<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class TasksController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'tasks' => Auth::user()->tasks
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
}

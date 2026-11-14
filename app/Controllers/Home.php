<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('pages/welcome', [
            'title' => 'Welcome',
            'tasks' => (new TaskModel())->getToday(),
            'today' => date('l, F j, Y'),
        ]);
    }
}
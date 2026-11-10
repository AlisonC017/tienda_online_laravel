<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerNavigation extends Controller
{
    public function dashboard()
    {
        return view('modules.admin.index');
    }

    public function login()
    {
        return view('login');
    }
}

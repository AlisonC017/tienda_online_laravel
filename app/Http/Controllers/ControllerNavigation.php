<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerNavigation extends Controller
{
    public function dashboard()
    {
        return auth()->user()->rol === 'administrador'
            ? redirect()->route('admin.index')
            : redirect()->route('tienda.index');
    }

    public function login()
    {
        return view('login');
    }
}

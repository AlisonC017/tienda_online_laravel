<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ControllerNavigation extends Controller
{
    public function landing()
    {
        return view('modules.landing.index');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('login', ['tab' => 'signup']);
    }

    public function dashboard()
    {
        return Auth::user()->esAdmin()
            ? redirect()->route('admin.index')
            : redirect()->route('tienda.index');
    }

    public function adminDashboard()
    {
        return view('modules.admin.index');
    }

    public function tiendaDashboard()
    {
        return view('modules.tienda.index');
    }
}

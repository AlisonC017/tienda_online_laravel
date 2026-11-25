<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;

class ControllerNavigation extends Controller
{

    public function landing()
    {
        $destacadas = Tienda::where('destacada', true)->where('activa', true)->get();

        return view('modules.landing.index', compact('destacadas'));
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

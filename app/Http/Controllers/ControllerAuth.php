<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControllerAuth extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $datos = [
            'correo' => $request->correo,
            'password' => $request->password
        ];

        if (Auth::attempt($datos)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Usuario o contraseña incorrectos'
        ])->onlyInput('user');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

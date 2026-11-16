<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;

class ControllerAuth extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:5'
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

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'No se pudo iniciar sesión con Google. Intenta de nuevo.',
            ]);
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('correo', $googleUser->getEmail())->first();

            if ($user) {
                //  no vincular Google a la cuenta administrador
                if ($user->esAdmin()) {
                    return redirect()->route('login')->withErrors([
                        'google' => 'Esta cuenta solo puede ingresar con correo y contraseña.',
                    ]);
                }

                $user->google_id = $googleUser->getId();
                $user->foto = $user->foto ?: $googleUser->getAvatar();
                $user->save();
            }
        }

        if (!$user) {
            $user = new User();
            $user->nombre    = $googleUser->getName();
            $user->correo    = $googleUser->getEmail();
            $user->foto      = $googleUser->getAvatar();
            $user->google_id = $googleUser->getId();
            $user->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}

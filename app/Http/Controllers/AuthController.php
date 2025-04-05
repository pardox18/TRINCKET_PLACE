<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{
    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirige al index después de un inicio de sesión exitoso
            return redirect()->route('index');
        }

        // Si las credenciales son incorrectas, vuelve al login con un error
        return redirect()->route('login')->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Registrar usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Cifra la contraseña
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir a la vista correcta
        return redirect()->route('index'); // Redirige a la vista de index.blade.php
    }

}

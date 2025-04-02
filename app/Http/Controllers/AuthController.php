<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register'); // Vista de registro
    }

    // Registrar nuevo usuario
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

        // Redirigir al welcome
        return redirect()->route('welcome');
    }

    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login'); // Vista de inicio de sesión
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            return redirect()->route('welcome'); // Redirigir al welcome después de iniciar sesión
        }

        // Si las credenciales no coinciden
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout(); // Cerrar sesión
        return redirect()->route('login'); // Redirigir al login
    }
}

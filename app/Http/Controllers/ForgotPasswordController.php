<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Muestra el formulario de recuperación de contraseña.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // Se debe tener la vista en resources/views/auth/forgot-password.blade.php
    }

    /**
     * Maneja la solicitud para enviar el enlace de restablecimiento de contraseña.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validar que el email es correcto y existe
        $request->validate([
            'email' => 'required|email|exists:users,email', // Valida que el correo esté registrado
        ]);

        // Enviar el enlace de restablecimiento de contraseña
        $status = Password::sendResetLink($request->only('email'));

        // Devolver la respuesta basada en si el enlace fue enviado con éxito
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)]) // Mostrar mensaje de éxito
            : back()->withErrors(['email' => __($status)]); // Mostrar error si algo salió mal
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // Método para mostrar la vista de inicio de sesión
    public function index()
    {
        // Solo se retorna la vista sin productos, ya que es para los formularios de login
        return view('auth.welcome');
    }

    // Método para manejar la búsqueda desde el welcome
    public function buscar(Request $request)
    {
        // Validación del campo de búsqueda (por si necesitas hacerlo en el futuro)
        $query = $request->input('search');

        // No mostramos productos en welcome
        return view('auth.welcome');
    }
}

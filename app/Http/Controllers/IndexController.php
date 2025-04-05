<?php

namespace App\Http\Controllers;

use App\Models\Product; // Modelo de Producto
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Método para mostrar la vista principal después de iniciar sesión
    public function index()
    {
        // Obtener todos los productos para mostrar en la vista index
        $productos = Product::all();

        // Retornar la vista 'auth.index' con los productos
        return view('auth.index', compact('productos'));
    }
}

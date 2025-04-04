<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Asegúrate de tener un modelo Producto

class WelcomeController extends Controller
{
// Método para mostrar la vista principal
public function index()
{
// Ejemplo de productos (celulares, ropa, electrodomésticos)
$productos = Product::all();

return view('welcome', compact('productos'));
}

// Método para manejar la búsqueda
public function buscar(Request $request)
{
$query = $request->input('search');

// Buscar productos por nombre o categoría
$productos = Product::where('nombre', 'like', "%$query%")
->orWhere('categoria', 'like', "%$query%")
->get();

return view('home', compact('productos'));
}
}

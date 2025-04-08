<?php

namespace App\Http\Controllers;

use App\Models\Product; // Modelo de Producto
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Método para mostrar la vista principal después de iniciar sesión
    public function index()
    {
        // Obtener todos los productos de la base de datos
        $products = Product::all()->map(function ($product) {
            return [
                'name'  => $product->name, // Cambiado de 'nombre' a 'name'
                'price' => $product->price, // Cambiado de 'precio' a 'price'
                'image' => asset('storage/' . $product->image), // Cambiado de 'imagen' a 'image'
                'route' => route('products.show', $product->id), // Enlace al producto
            ];
        });

        // Pasar la variable 'products' a la vista
        return view('auth.index', compact('products'));
    }
}

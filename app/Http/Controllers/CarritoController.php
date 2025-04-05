<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
    
        // Calcular el total
        $total = array_sum(array_column($carrito, 'precio')); // O cualquier otra lógica para el total
    
        return view('auth.carrito.index', compact('carrito', 'total'));
    }
    


    // Eliminar un producto del carrito
    public function eliminar($id)
{
    // Obtener el carrito de la sesión
    $carrito = session()->get('carrito', []);

    // Verificar si el producto existe en el carrito
    if (isset($carrito[$id])) {
        // Eliminar el producto del carrito
        unset($carrito[$id]);
        
        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);
        
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    return redirect()->route('carrito.index')->with('error', 'Producto no encontrado en el carrito');
}


    // Vaciar el carrito
    public function vaciar()
{
    // Vaciar el carrito de la sesión
    session()->forget('carrito');

    return redirect()->route('carrito.index')->with('success', 'El carrito ha sido vaciado');
}


    // Agregar un producto al carrito
    public function agregarAlCarrito($id)
{
    // Verificar si el producto existe
    $producto = Product::find($id);

    if (!$producto) {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }

    // Obtener el carrito de la sesión
    $carrito = session()->get('carrito', []);

    // Verificar si el producto ya está en el carrito
    if (isset($carrito[$id])) {
        // Si ya está en el carrito, aumentar la cantidad
        $carrito[$id]['cantidad']++;
    } else {
        // Si no está en el carrito, agregarlo con cantidad 1
        $carrito[$id] = [
            'nombre' => $producto->name,
            'precio' => $producto->price,
            'cantidad' => 1,
            'imagen' => $producto->image_url,  // Asegúrate de que el modelo tenga una URL de imagen
        ];
    }

    // Guardar el carrito en la sesión
    session()->put('carrito', $carrito);

    return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
}

}

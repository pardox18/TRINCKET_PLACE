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

        // Calcular el total sumando precio * cantidad
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('auth.carrito.index', compact('carrito', 'total'));
    }

    // Eliminar un producto del carrito
    public function eliminar($id)
{
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        unset($carrito[$id]);
        session()->put('carrito', $carrito);
    }

    return redirect()->back()->with('success', 'Producto eliminado del carrito');
}


    // Vaciar el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'El carrito ha sido vaciado');
    }

    // Agregar un producto desde la base de datos
    public function agregarAlCarrito($id)
    {
        $producto = Product::findOrFail($id);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre' => $producto->name,
                'precio' => $producto->price,
                'imagen' => $producto->image_url,
                'cantidad' => 1
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    // Agregar un producto manualmente (sin estar en la base de datos)
    public function agregarProductoManual(Request $request)
    {
        $id = uniqid(); // Genera un ID único para cada producto agregado manualmente

        $producto = [
            'nombre' => $request->input('name'),
            'precio' => $request->input('price'),
            'imagen' => $request->input('image_url'),
            'cantidad' => 1,
        ];

        $carrito = session()->get('carrito', []);
        $carrito[$id] = $producto;
        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    // ✅ Actualizar cantidades del carrito
    public function actualizar(Request $request)
    {
        $cantidades = $request->input('cantidades', []);
        $carrito = session()->get('carrito', []);

        foreach ($cantidades as $id => $cantidad) {
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad'] = max(1, intval($cantidad));
            }
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado correctamente.');
    }
}
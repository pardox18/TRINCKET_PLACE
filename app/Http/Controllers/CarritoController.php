<?php

namespace App\Http\Controllers;

use App\Models\Productoo;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // CarritoController.php
public function index()
{
    $carrito = session()->get('carrito', []);

    $total = 0;
    foreach ($carrito as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    return view('carrito.index', compact('carrito', 'total'));
}



public function agregar(Request $request, $productId)
{
    $producto = Productoo::findOrFail($productId);

    Carrito::updateOrCreate(
        ['producto_id' => $producto->id, 'usuario_id' => Auth::id()],
        ['cantidad' => $request->input('cantidad', 1)]
    );

    return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito');
}

    public function eliminar($id)
    {
        $item = Carrito::findOrFail($id);
        $item->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }
    public function actualizar(Request $request)
    {
        $cantidades = $request->input('cantidades');
    
        $carrito = session()->get('carrito', []);
    
        foreach ($cantidades as $id => $cantidad) {
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad'] = max(1, intval($cantidad)); // Asegurar que sea mínimo 1
            }
        }
    
        session()->put('carrito', $carrito);
        
        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }
    



}

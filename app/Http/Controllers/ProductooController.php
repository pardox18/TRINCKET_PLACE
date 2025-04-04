<?php

namespace App\Http\Controllers;
use App\Models\Carrito;
use App\Models\Productoo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductooController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Productoo::all();
        return view('productoo.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('productoo.create');
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Productoo::create($request->all());
        return redirect()->route('productoo.index')->with('success', 'Producto creado');
    }

    // Agregar al carrito
    public function agregarAlCarrito($id)
    {
        $producto = Productoo::findOrFail($id);
        Carrito::updateOrCreate(
            ['producto_id' => $producto->id, 'usuario_id' => Auth::id()],
            ['cantidad' => 1]
        );

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito');
    }
}

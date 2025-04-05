<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::all();
        return view('auth.products.index', compact('products'));
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('perfil')->with('error', 'Producto no encontrado.');
        }

        return view('auth.products.show', compact('product'));
    }

    // Mostrar formulario para crear un producto
    public function create()
    {
        return view('auth.products.create');
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Guardar la imagen en storage
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
            'user_id'     => Auth::id(), // Asocia al usuario logueado
        ]);

        return redirect()->route('perfil')->with('success', 'Producto publicado correctamente.');
    }

    // Mostrar formulario para editar un producto
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('perfil')->with('error', 'Producto no encontrado.');
        }

        return view('auth.products.edit', compact('product'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('perfil')->with('error', 'Producto no encontrado.');
        }

        $product->update($request->only(['name', 'description', 'price']));

        return redirect()->route('perfil')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('perfil')->with('error', 'Producto no encontrado.');
        }

        $product->delete();

        return redirect()->route('perfil')->with('success', 'Producto eliminado correctamente.');
    }
}

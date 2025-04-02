<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('products.index', compact('products')); // Retorna la vista con los productos
    }

    // Mostrar formulario para crear un producto
    public function create()
    {
        return view('products.create'); // Vista para crear un producto
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
        ]);

        // Crear el producto en la base de datos
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        // Redirigir a la lista de productos
        return redirect()->route('products.index');
    }

    // Mostrar formulario para editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Buscar producto por ID
        return view('products.edit', compact('product')); // Vista para editar el producto
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Buscar y actualizar el producto
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        // Redirigir al índice de productos
        return redirect()->route('products.index');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Eliminar el producto

        // Redirigir al índice de productos
        return redirect()->route('products.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
{
    return view('auth.index'); // ✅ Carga directamente auth/index.blade.php
}
    public function show(Product $product)
    {
        return view('auth.products.show', compact('product'));
    }

    public function create()
    {
        return view('auth.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'nullable|integer|min:0',
            'category'    => 'nullable|string|max:255',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'category'    => $request->category,
            'image'       => $imagePath,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('profile.show')->with('success', 'Producto publicado correctamente.');
    }

    public function edit(Product $product)
    {
        return view('auth.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'nullable|integer|min:0',
            'category'    => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('profile.show')->with('error', 'Producto no encontrado.');
        }

        // Si hay nueva imagen, reemplaza la antigua
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->quantity    = $request->quantity;
        $product->category    = $request->category;
        $product->save();

        return redirect()->route('profile.show')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('profile.show')->with('error', 'Producto no encontrado.');
        }

        $product->delete();

        return redirect()->route('profile.show')->with('success', 'Producto eliminado correctamente.');
    }

    public function accesorios()
    {
        $productos = Product::whereHas('category', function ($query) {
            $query->where('name', 'accesorios');
        })->get();

        return view('categorias.accesorios', compact('productos'));
    }
}

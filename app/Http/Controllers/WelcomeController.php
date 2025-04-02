<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('welcome', compact('products')); // Retornar la vista 'welcome'
    }
}

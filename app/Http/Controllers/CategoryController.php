<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($categoria)
    {
        // Verificamos que la categoría esté en la lista permitida.
        if (in_array($categoria, ['accesorios', 'moda', 'a_mano', 'artesano'])) {
            return view('auth.categorias.' . $categoria);  // La vista debe estar en auth/categorias/{categoria}.blade.php
        } else {
            // Si la categoría no es válida, podrías redirigir a una página de error o la página principal
            return redirect()->route('welcome');
        }
    }
}
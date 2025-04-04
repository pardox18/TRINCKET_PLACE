<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($categoria)
    {
        // Convertir "-" en "_" para asegurar compatibilidad con nombres de vistas
        $categoria = str_replace('-', '_', $categoria);

        // Lista de categorías y sus vistas asociadas
        $categorias = [
            'accesorios' => 'auth.categorias.accesorios',
            'moda'       => 'auth.categorias.moda',
            'a_mano'     => 'auth.categorias.a_mano',
            'artesano'   => 'auth.categorias.artesano',
        ];

        // Verifica si la categoría existe
        if (!array_key_exists($categoria, $categorias)) {
            abort(404, 'Categoría no encontrada.');
        }

        // Verifica si la vista existe antes de devolverla
        if (!view()->exists($categorias[$categoria])) {
            abort(500, 'La vista para la categoría "'.$categoria.'" no está disponible.');
        }

        return view($categorias[$categoria]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Campos asignables en el modelo
    protected $fillable = [
        'nombre',          // Cambié 'name' por 'nombre' para que coincida con los datos
        'descripcion',     // Cambié 'description' por 'descripcion'
        'precio',          // Cambié 'price' por 'precio'
        'category_id',
    ];

    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

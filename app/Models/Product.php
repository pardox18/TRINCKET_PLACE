<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'name', 'description', 'price', 'category_id',
    ];

    // Relación inversa con Category (un producto pertenece a una categoría)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación muchos a muchos con Order (un producto puede estar en muchos pedidos)
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // Relación uno a muchos con Comment (un producto puede tener muchos comentarios)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

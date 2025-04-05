<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    // Especificamos los campos que pueden ser llenados masivamente
    protected $fillable = [
        'user_id', 'product_id', 'cantidad'
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Product
    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

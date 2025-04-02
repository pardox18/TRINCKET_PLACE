<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Especifica los atributos que se pueden asignar masivamente
    protected $fillable = [
        'user_id', 'product_id', 'comment',
    ];

    // Relación inversa con User: un comentario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación inversa con Product: un comentario pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

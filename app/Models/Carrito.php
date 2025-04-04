<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'usuario_id'
    ];

    public function producto()
    {
        return $this->belongsTo(Productoo::class);
    }
}

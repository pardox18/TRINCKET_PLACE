<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'precio', 'imagen', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Campos asignables en el modelo
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Atributos que deben ocultarse en las respuestas JSON
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Atributos que se deben convertir a tipos de datos específicos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

// En el modelo User
// En el modelo User (App\Models\User.php)
public function carrito()
{
    return $this->hasMany(Carrito::class);  // Suponiendo que un usuario puede tener varios productos en su carrito
}


}

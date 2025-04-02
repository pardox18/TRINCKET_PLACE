<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Relación muchos a muchos con Role (un usuario puede tener varios roles)
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Relación muchos a muchos con Permission (un usuario puede tener varios permisos)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Relación uno a muchos con Order (un usuario puede tener varias órdenes)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

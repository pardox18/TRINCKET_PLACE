<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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

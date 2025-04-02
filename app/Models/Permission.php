<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'name', 'description',
    ];

    // Relación muchos a muchos con Role
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Relación muchos a muchos con User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

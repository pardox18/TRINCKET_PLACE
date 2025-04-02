<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'name', 'description',
    ];

    // Relación muchos a muchos con User (un rol puede tener muchos usuarios)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relación muchos a muchos con Permission (un rol puede tener muchos permisos)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

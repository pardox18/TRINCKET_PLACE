<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Especifica los atributos que se pueden asignar masivamente
    protected $fillable = [
        'user_id', 'total_amount', 'status',
    ];

    // Relación inversa con User: una orden pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Product: una orden puede tener muchos productos
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // Relación con Payment: una orden tiene un solo pago
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

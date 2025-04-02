<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'order_id', 'payment_method', 'amount', 'status',
    ];

    // Relación inversa con Order: un pago pertenece a una orden
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('auth.metodo_pago.index');  // Ruta de la vista correcta
    }

    // Otros métodos para manejar el pago
}

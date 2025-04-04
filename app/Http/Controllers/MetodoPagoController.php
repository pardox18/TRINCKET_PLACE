<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $total = session('carrito_total', 0); 
        return view('metodo_pago.index', compact('total'));
    }
    

    public function procesarPago(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'metodo_pago' => 'required|string',
            'monto' => 'required|numeric|min:0.01'
        ]);

        // Aquí podrías guardar los datos o procesar el pago

        return redirect()->route('carrito.index')->with('success', 'Pago procesado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Muestra la vista de métodos de pago y el total de la compra.
     */
    public function index()
    {
        // Recuperar el total del carrito desde la sesión, si existe
        $total = session('carrito_total', 0); 

        // Retorna la vista de métodos de pago con el total de la compra
        return view('metodo_pago.index', compact('total'));
    }

    /**
     * Procesa el pago realizado por el usuario.
     */
    public function procesarPago(Request $request)
    {
        // Validación de los datos del formulario de pago
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'metodo_pago' => 'required|string',
            'monto' => 'required|numeric|min:0.01' // Validar que el monto sea un número positivo
        ]);

        // Aquí deberías agregar la lógica para procesar el pago
        // Esto puede ser mediante una pasarela de pago como Stripe, PayPal, etc.
        // Por ejemplo:
        // PaymentService::procesarPago($request->all());

        // Después de procesar el pago, puedes hacer lo siguiente:
        return redirect()->route('carrito.index')->with('success', 'Pago procesado exitosamente.');
    }
}

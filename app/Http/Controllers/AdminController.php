<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Aseguramos que solo los usuarios autenticados puedan acceder a esta sección
        $this->middleware('auth');
    }

    public function dashboard()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        // Trae todos los usuarios excepto el mismo admin (opcional)
        $usuarios = \App\Models\User::where('id', '!=', $user->id)->get();

        return view('auth.admin.dashboard', compact('usuarios'));
    } else {
        return redirect()->route('index');
    }
}

}

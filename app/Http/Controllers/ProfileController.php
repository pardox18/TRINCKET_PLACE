<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Método para mostrar la vista del perfil
    public function show()
    {
        if (!view()->exists('auth.profile')) {
            abort(404, 'Página no encontrada');
        }
        
        return view('auth.profile');
    }

    // Método para actualizar el perfil del usuario
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            // Eliminar la imagen anterior si existe
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Guardar la nueva imagen
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Guardar cambios en la base de datos
        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('profile.show', [
            'user' => $user,
            'pedidos' => $user->pedidos()->with('estado')->latest('fecha_pedido')->take(5)->get(),
        ]);
    }

    /**
     * Update the user's shipping information (RF-05).
     */
    public function updateShipping(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'telefono' => ['nullable', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:200'],
            'barrio' => ['required', 'string', 'max:100'],
            'ciudad' => ['required', 'string', 'max:100'],
        ], [
            'direccion.required' => 'La dirección es obligatoria para tus envíos.',
            'barrio.required' => 'El barrio es obligatorio para tus envíos.',
            'ciudad.required' => 'La ciudad es obligatoria.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'telefono' => $validated['telefono'] ?? $user->telefono,
            'direccion' => $validated['direccion'],
            'barrio' => $validated['barrio'],
            'ciudad' => $validated['ciudad'],
        ]);

        return redirect()->route('perfil')
            ->with('success', 'Datos de envío actualizados correctamente.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña actual.',
            'password.required' => 'Ingresa la nueva contraseña.',
            'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->update([
            'password' => $validated['password'],
        ]);

        return redirect()->route('perfil')
            ->with('success', 'Tu contraseña ha sido actualizada con éxito.');
    }
}

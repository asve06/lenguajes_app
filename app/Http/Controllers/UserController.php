<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', ['user' => $user]);
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(RegisterRequest $request, User $user)
    {
        $validatedData = $request->validated();
        // Verifica si se proporcionó una nueva contraseña y actualiza el campo correspondiente
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Si no se proporcionó una nueva contraseña, elimina la clave del array para evitar problemas al actualizar
            unset($validatedData['password']);
        }
        
        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'Proveedor actualizado exitosamente');
    }

    public function destroy(User $user)
    {
        //
    }
}

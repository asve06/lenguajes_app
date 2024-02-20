<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', ['user' =>$user]);
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
        //$user::update($request->validated());
        //return redirect()->route('users.index')->with('success', 'proveedor actualizado exitosamente');
    }

    public function destroy(User $user)
    {
        //
    }
}

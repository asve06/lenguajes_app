<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    
    public function index()
    {
        $username = Auth::user()->username;
        return view('user.categoria', ['username' =>$username]);
         
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Categorias $categorias)
    {
        //
    }

    public function edit(Categorias $categorias)
    {
        //
    }

    public function update(Request $request, Categorias $categorias)
    {
        //
    }

    public function destroy(Categorias $categorias)
    {
        //
    }
}

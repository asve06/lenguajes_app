<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{

    public function index()
    {
        $categorias = DB::table('categorias')->get();
        return view('user.categoria', ['categorias' => $categorias]);
    }

    public function create()
    {
        //return view('adds.cCategoria');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'detalles' => 'required',
        ]);
        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'categoria created successfully');
    }


    public function show(Categoria $categoria)
    {
        
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit', compact('categoria'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'detalles' => 'required',
        ]);
        $categoria = Categoria::find($id);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'categoria actualizada exitosamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'categoria eliminada exitosamente');
    }
}

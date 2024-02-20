<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Egreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class EgresoController extends Controller
{
    
    public function index()
    {
        $egresos = Egreso::with('producto')->get();
        $productos = Producto::all();
        return view('user.egreso', ['egresos' => $egresos, 'productos' => $productos]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'cantidad_egresada' => 'required',
            'productoID' => 'required|exists:productos,productoID'
        ]);
        Egreso::create($request->all());
        return redirect()->route('egresos.index')->with('success', 'Egreso creado exitosamente');
    }


    public function show(Egreso $egreso)
    {
        //
    }

    public function edit(Egreso $egreso)
    {
        //
    }

    public function update(Request $request, Egreso $egreso)
    {
        $request->validate([
            'cantidad_egresada' => 'required',
            'productoID' => 'required|exists:productos,productoID'
        ]);

        $egreso->update($request->all());
        return redirect()->route('egresos.index')->with('success', 'Egreso actualizado exitosamente');
    }

    public function destroy(Egreso $egreso)
    {
        $egreso->delete();
        return redirect()->route('egresos.index')->with('success', 'Egreso eliminado exitosamente');
    }
}

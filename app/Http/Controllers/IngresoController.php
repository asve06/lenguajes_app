<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class IngresoController extends Controller
{
    
    public function index()
    {
        $ingresos = Ingreso::with('producto')->get();
        return view('user.ingreso', ['ingresos' => $ingresos]);
    }

    public function create()
    {
        //return view('adds.cingreso');
    }


    public function store(Request $request)
{
    $request->validate([
        'cantidad_ingresada' => 'required',
        'productoId' => 'required'
    ]);
    Ingreso::create($request->all());
    return redirect()->route('ingresos.index')->with('success', 'Ingreso creado exitosamente');
}


    public function show(Ingreso $ingreso)
    {
        //
    }

    public function edit(Ingreso $ingreso)
    {
        $ingreso = Ingreso::find($ingreso->ingresoID);
        return view('ingresos.edit', compact('ingreso'));
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'cantidad_ingresada' => 'required',
        ]);

        $ingreso->update($request->all());

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado exitosamente');
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso = Ingreso::find($ingreso->ingresoID);
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'ingreso eliminada exitosamente');
    }
}

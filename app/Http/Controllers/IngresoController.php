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
        $productos = Producto::all();
        return view('user.ingreso', ['ingresos' => $ingresos, 'productos' => $productos]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
{
    $request->validate([
        'cantidad_ingresada' => 'required',
        'productoid' => 'required|exists:productos,productoid'
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
        //
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'cantidad_ingresada' => 'required',
            'productoid' => 'required|exists:productos,productoid'
        ]);

        $ingreso->update($request->all());
        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado exitosamente');
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'ingreso eliminada exitosamente');
    }
}

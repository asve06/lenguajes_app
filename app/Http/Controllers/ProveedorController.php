<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{

    public function index()
    {
        $proveedors = DB::table('proveedors')->get();
        return view('user.proveedor', ['proveedors' => $proveedors]);
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'direccion' => 'required'
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedors.index')->with('success', 'proveedor creado exitosamente');
    }


    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit(Proveedor $proveedor)
    {
        //
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'direccion' => 'required'
        ]);
        $proveedor->update($request->all());

        return redirect()->route('proveedors.index')->with('success', 'proveedor actualizado exitosamente');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedors.index')->with('success', 'proveedor eliminado exitosamente');
    }
}
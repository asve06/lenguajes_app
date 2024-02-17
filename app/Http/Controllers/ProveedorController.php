<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{

    public function index()
    {
        $proveedores = DB::table('proveedores')->get();
        return view('user.proveedor', ['proveedores' => $proveedores]);
    }

    public function create()
    {
        //return view('adds.cProveedor');
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
        return redirect()->route('proveedores.index')->with('success', 'proveedor creado exitosamente');
    }


    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit(Proveedor $proveedor)
    {
        $proveedor = Proveedor::find($proveedor->proveedorID);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'direccion' => 'required'
        ]);
        $proveedor = Proveedor::find($proveedor->proveedorID);
        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'proveedor actualizado exitosamente');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor = Proveedor::find($proveedor->proveedorID);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'proveedor eliminado exitosamente');
    }
}
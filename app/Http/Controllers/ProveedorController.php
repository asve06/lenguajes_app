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
            'direccion' => 'required',
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'proveedor created successfully');
    }


    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.edit', compact('proveedor'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'direccion' => 'required',
        ]);
        $proveedor = Proveedor::find($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'proveedor updated successfully');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'proveedor deleted successfully');
    }
}

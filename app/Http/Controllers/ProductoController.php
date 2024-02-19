<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::with('categoria', 'proveedor')->get();
        $categorias = Categoria::all();
        $proveedors = Proveedor::all();
        return view('user.producto', ['productos' => $productos, 'categorias' => $categorias, 'proveedors' => $proveedors]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'existencia_actual' => 'required',
            'categoriaID' => 'required|exists:categorias,categoriaID',
            'proveedorID' => 'required|exists:proveedors,proveedorID',
        ]);
        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'producto created successfully');
    }

    public function show(Producto $producto)
    {
        //
    }

    public function edit(Producto $producto)
    {
        //
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'existencia_actual' => 'required',
            'categoriaID' => 'required|exists:categorias,categoriaID',
            'proveedorID' => 'required|exists:proveedors,proveedorID',
        ]);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'producto eliminada exitosamente');
    }
}

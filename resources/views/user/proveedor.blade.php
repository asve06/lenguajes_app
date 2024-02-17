@extends('layout.layout')
@section('content')
<h1 class="mb-5">Proveedores</h1>
<table class="table">
    <thead>
        <tr>
            <th class="col-1" scope="col">Id</th>
            <th class="col-3" scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Número</th>
            <th scope="col">Dirección</th>
            <th class="col-1" scope="col">Editar</th>
            <th class="col-1" scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
        <tr>
            <th scope="row">{{ $proveedor->proveedorID }}</th>
            <td>{{ $proveedor->nombre }}</td>
            <td>{{ $proveedor->apellido }}</td>
            <td>{{ $proveedor->numero }}</td>
            <td>{{ $proveedor->direccion }}</td>
            <td>
                <button href="{{ route('proveedores.edit', ['proveedor'=>$proveedor->proveedorID]) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaleditar">Editar</button>
            </td>
            <td>
                <form action="{{ route('proveedores.destroy', ['proveedor'=>$proveedor->proveedorID]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">x</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <th scope="row">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcrear">+</button>
            </th>
        </tr>
    </tbody>
</table>
<div class="modal" id="modalcrear" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modaleditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('proveedores.update',['proveedor'=>$proveedor->proveedorID]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

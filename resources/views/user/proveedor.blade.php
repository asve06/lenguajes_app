@extends('layout.layout')
@section('content')
@auth
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
        @foreach ($proveedors as $proveedor)
        <tr>
            <th scope="row">{{ $proveedor->proveedorID }}</th>
            <td>{{ $proveedor->nombre }}</td>
            <td>{{ $proveedor->apellido }}</td>
            <td>{{ $proveedor->numero }}</td>
            <td>{{ $proveedor->direccion }}</td>
            <td>
                <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#modaleditar" 
                data-proveedorid="{{ $proveedor->proveedorID }}" 
                data-nombre="{{ $proveedor->nombre }}"
                data-apellido="{{ $proveedor->apellido }}"
                data-numero="{{ $proveedor->numero }}"
                data-direccion="{{ $proveedor->direccion }}">Editar</button>            
            </td>
            <td>
                <form action="{{ route('proveedors.destroy', ['proveedor'=>$proveedor->proveedorID]) }}" method="POST">
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
            <form action="{{ route('proveedors.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-proveedor="Close"></button>
            </div>
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('.editBtn').click(function(){
    var proveedorId = $(this).data('proveedorid');
    var nombre = $(this).data('nombre');
    var apellido = $(this).data('apellido');
    var numero = $(this).data('numero');
    var direccion = $(this).data('direccion');
    
    var form = $('#modaleditar form');
    var actionUrl = "{{ route('proveedors.update', ['proveedor' => ':id']) }}".replace(':id', proveedorId);
    
    form.attr('action', actionUrl);
    $('#modaleditar #nombre').val(nombre);
    $('#modaleditar #apellido').val(apellido);
    $('#modaleditar #numero').val(numero);
    $('#modaleditar #direccion').val(direccion);
  });
});
</script>
@endauth
@endsection
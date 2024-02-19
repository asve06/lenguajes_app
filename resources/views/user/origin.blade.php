@extends('layout.layout')

@section('content')
<h1 class="mb-5">Proveedores</h1>

<table class="table">
    <thead>
        <tr>
            <th class="col-1" scope="col">Id</th>
            <th class="col-3" scope="col">Nombre</th>
            <th class="col-3" scope="col">Apellido</th>
            <th class="col-2" scope="col">Numero</th>
            <th class="col-3" scope="col">Direccion</th>
            <th class="col-1" scope="col">Editar</th>
            <th class="col-1" scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($origins as $origin)
        <tr>
            <th scope="row">{{ $origin->originID }}</th>
            <td>{{ $origin->name }}</td>
            <td>{{ $origin->surname }}</td>
            <td>{{ $origin->number }}</td>
            <td>{{ $origin->address }}</td>
            <td>
                <button class="btn btn-primary editOriginBtn" data-bs-toggle="modal" data-bs-target="#modaleditar"
                                data-originid="{{ $origin->originID }}" 
                                data-name="{{ $origin->name }}" 
                                data-surname="{{ $origin->surname }}"
                                data-number="{{ $origin->number }}"
                                data-address="{{ $origin->address }}">Editar</button>
            </td>
            <td>
                <form action="{{ route('origins.destroy', ['origin' => $origin->originID]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
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

<!-- Crear -->
<div class="modal" id="modalcrear" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Origin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('origins.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" required>
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

<!-- Edit -->
<div class="modal" id="modaleditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Origin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" required>
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
    $('.editOriginBtn').click(function(){
        var originId = $(this).data('originid');
        var name = $(this).data('name');
        var surname = $(this).data('surname');
        var number = $(this).data('number');
        var address = $(this).data('address');
        
        var form = $('#modaleditar form');
        var actionUrl = "{{ route('origins.update', ['origin' => ':id']) }}".replace(':id', originId);
        
        form.attr('action', actionUrl);
        $('#modaleditar #name').val(name);
        $('#modaleditar #surname').val(surname);
        $('#modaleditar #number').val(number);
        $('#modaleditar #address').val(address);
    });
});
</script>

@endsection

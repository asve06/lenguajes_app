@extends('layout.layout')
@section('content')
<h1 class="mb-5">Ingresos</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Cantidad Ingresada</th>
      <th scope="col">Time</th>
      <th scope="col">Productos</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($ingresos as $ingreso)
    <tr>
      <th scope="row">{{ $ingreso->ingresoID }}</th>
      <td>{{ $ingreso->cantidad_ingresada }}</td>
      <td>{{ $ingreso->created_at }}</td> 
      <td>{{ $ingreso->producto->nombre }}</td> <!-- Mover esta línea fuera del modal -->

      <td>
        <a href="{{ route('ingresos.edit', ['ingreso'=>$ingreso->ingresoID]) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaleditari{{ $ingreso->ingresoID }}">Editar</a>
      </td>
      <td>
        <form action="{{ route('ingresos.destroy', ['ingreso'=>$ingreso->ingresoID]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
    <tr>
      <th scope="row">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcreari">+</button>
      </th>
    </tr>
  </tbody>
</table>
<div class="modal" id="modalcreari" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Ingreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('ingresos.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="cantidad_ingresada" class="form-label">Cantidad Ingresada</label>
            <input type="text" class="form-control" id="cantidad_ingresada" name="cantidad_ingresada">
          </div>
          <div class="mb-3">
            <label for="productoId" class="form-label">Producto ID</label>
            <input type="text" class="form-control" id="productoId" name="productoId">
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
<div class="modal" id="modaleditari{{ $ingreso->ingresoID }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Ingreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('ingresos.update',['ingreso'=>$ingreso->ingresoID]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="cantidad_ingresada" class="form-label">Cantidad Ingresada</label>
            <input value="{{ $ingreso->cantidad_ingresada ?? 'No encontrado' }}" type="text" class="form-control" id="cantidad_ingresada" name="cantidad_ingresada">
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

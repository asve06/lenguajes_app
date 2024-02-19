@extends('layout.layout')
@section('content')
<h1 class="mb-5">Categorias</h1>
@yield('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Detalles</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
  </thead>
  <tbody>
    @foreach ($categorias as $categoria)
    <tr>
        <th scope="row">{{ $categoria->categoriaID }}</th>
        <td>{{ $categoria->nombre }}</td>
        <td>{{ $categoria->detalles }}</td>
        <td>
          <button href="{{ route('categorias.edit', ['categoria'=>$categoria->categoriaID]) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaleditar">Editar</button>
        </td>
        <td>
          <form action="{{ route('categorias.destroy', ['categoria'=>$categoria->categoriaID]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">x</button>
          </form>
        </td>
    </tr>
    @endforeach
    <tr>
      <th scope="row">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcrear" >+</button>
      </th>
    </tr>
  </tbody>
</table>
<div class="modal" id="modalcrear" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
              <label for="detalles" class="form-label">Detalles</label>
              <input type="text" class="form-control" id="detalles" name="detalles">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        <h5 class="modal-title">Editar Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('categorias.update',['categoria'=>$categoria->categoriaID]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input value="{{$categoria->nombre ?? 'No encontrado'}} "type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
              <label for="detalles" class="form-label">Detalles</label>
              <input value="{{$categoria->detalles ?? 'No encontrado'}}" type="text" class="form-control" id="detalles" name="detalles">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
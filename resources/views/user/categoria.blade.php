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
          <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#modaleditar" 
          data-categoriaid="{{ $categoria->categoriaID }}" 
          data-nombre="{{ $categoria->nombre }}"
          data-detalles="{{ $categoria->detalles }}">Editar</button>        
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
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="detalles" class="form-label">Detalles</label>
              <input type="text" class="form-control" id="detalles" name="detalles" required>
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
              <h5 class="modal-title">Editar categoria</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-categoria="Close"></button>
          </div>
          <form method="POST">
              @csrf
              @method('PUT')
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="nombre" class="form-categoria">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre">
                  </div>
                  <div class="mb-3">
                      <label for="detalles" class="form-categoria">Detalles</label>
                      <input type="text" class="form-control" id="detalles" name="detalles">
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
    var categoriaId = $(this).data('categoriaid');
    var nombre = $(this).data('nombre');
    var detalles = $(this).data('detalles');
    
    var form = $('#modaleditar form');
    var actionUrl = "{{ route('categorias.update', ['categoria' => ':id']) }}".replace(':id', categoriaId);
    
    form.attr('action', actionUrl);
    $('#modaleditar #nombre').val(nombre);
    $('#modaleditar #detalles').val(detalles);
  });
});
</script>
@endsection
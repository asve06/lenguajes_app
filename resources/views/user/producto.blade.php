@extends('layout.layout')
@section('content')
@auth  
<h1 class="mb-5">Productos</h1>
<table class="table">
  <thead>
    <tr>
      <th class="col">Id</th>
      <th class="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Descripción</th>
      <th scope="col">Existencia</th>
      <th scope="col">Categoria</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $producto)
      <tr>
        <th scope="row">{{ $producto->productoid }}</th>
        <td>{{ $producto->nombre }}</td>
        <td>{{ $producto->precio }}</td>
        <td>{{ $producto->descripcion }}</td>
        <td>{{ $producto->existencia_actual }}</td>  
        <td>{{ $producto->categoria->nombre}}</td>
        <td>{{ $producto->proveedor->nombre}}</td>
        <td>
          <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#modaleditar" 
          data-productoid="{{ $producto->productoid }}" 
          data-nombre="{{ $producto->nombre }}"
          data-precio="{{ $producto->precio }}"
          data-descripcion="{{ $producto->descripcion }}"
          data-existencia_actual="{{ $producto->existencia_actual }}"
          data-categoriaid="{{ $producto->categoriaID }}"
          data-proveedorid="{{ $producto->proveedorID }}">Editar</button> 
        </td>
        <td>
          <form action="{{route('productos.destroy', ['producto'=>$producto->productoid])}}" method="POST">
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
        <h5 class="modal-title">Agregar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" required>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
          </div>
          <div class="mb-3">
            <label for="existencia_actual" class="form-label">Existencia actual</label>
            <input type="text" class="form-control" id="existencia_actual" name="existencia_actual" required>
          </div>
          <div class="mb-3">
            <label for="categoriaID" class="form-label">Categoría</label>
            <select class="form-select" id="categoriaID" name="categoriaID" required>
                <option value="">Selecciona una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="proveedorID" class="form-label">Proveedor</label>
            <select class="form-select" id="proveedorID" name="proveedorID" required>
                <option value="">Selecciona un Proveedor</option>
                @foreach ($proveedors as $proveedor)
                    <option value="{{ $proveedor->proveedorID }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
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
              <h5 class="modal-title">Editar producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-producto="Close"></button>
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
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>
                <div class="mb-3">
                  <label for="existencia_actual" class="form-label">Existencia</label>
                  <input type="text" class="form-control" id="existencia_actual" name="existencia_actual" required>
                </div>
                <div class="mb-3">
                  <label for="categoriaID" class="form-label">Categoría</label>
                  <select class="form-select" id="categoriaID" name="categoriaID" required>
                      <option value="">Selecciona una categoría</option>
                      @foreach ($categorias as $categoria)
                          <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="proveedorID" class="form-label">Proveedor</label>
                  <select class="form-select" id="proveedorID" name="proveedorID" required>
                      <option value="">Selecciona un Proveedor</option>
                      @foreach ($proveedors as $proveedor)
                          <option value="{{ $proveedor->proveedorID }}">{{ $proveedor->nombre }}</option>
                      @endforeach
                  </select>
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
    var productoid = $(this).data('productoid');
    var nombre = $(this).data('nombre');
    var precio = $(this).data('precio');
    var descripcion = $(this).data('descripcion');
    var existencia = $(this).data('existencia_actual');
    var categoriaid = $(this).data('categoriaid');
    var proveedorid = $(this).data('proveedorid');
    
    var form = $('#modaleditar form');
    var actionUrl = "{{ route('productos.update', ['producto' => ':id']) }}".replace(':id', productoid);
    
    form.attr('action', actionUrl);
    $('#modaleditar #nombre').val(nombre);
    $('#modaleditar #precio').val(precio);
    $('#modaleditar #descripcion').val(descripcion);
    $('#modaleditar #existencia_actual').val(existencia);
    $('#modaleditar #categoriaID').val(categoriaid);
    $('#modaleditar #proveedorID').val(proveedorid);
  });
});
</script>
@endauth
@endsection
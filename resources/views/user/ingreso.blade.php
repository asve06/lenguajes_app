@extends('layout.layout')
@section('content')
<h1 class="mb-5">Ingresos</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Cantidad Ingresada</th>
      <th scope="col">Fecha</th>
      <th scope="col">Producto</th>
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
      <td>{{ $ingreso->producto->nombre }}</td>
      <td>
        <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#modaleditar" 
        data-ingresoid="{{ $ingreso->ingresoID }}" 
        data-cantidad_ingresada="{{ $ingreso->cantidad_ingresada }}"
        data-productoid="{{ $ingreso->productoid }}">Editar</button>        
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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcrear">+</button>
      </th>
    </tr>
  </tbody>
</table>
<div class="modal" id="modalcrear" tabindex="-1">
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
            <input type="text" class="form-control" id="cantidad_ingresada" name="cantidad_ingresada" required>
          </div>
          <div class="mb-3">
            <label for="productoid" class="form-label">Producto</label>
            <select class="form-select" id="productoid" name="productoid" required>
                <option value="">Selecciona un Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->productoid }}">{{ $producto->nombre }}</option>
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
              <h5 class="modal-title">Editar Proveedor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-proveedor="Close"></button>
          </div>
          <form method="POST">
              @csrf
              @method('PUT')
              <div class="modal-body">
                <div class="mb-3">
                  <label for="cantidad_ingresada" class="form-label">Cantidad Ingresada</label>
                  <input type="text" class="form-control" id="cantidad_ingresada" name="cantidad_ingresada" required>
                </div>
                <div class="mb-3">
                  <label for="productoid" class="form-label">Producto</label>
                  <select class="form-select" id="productoid" name="productoid" required>
                      <option value="">Selecciona un Producto</option>
                      @foreach ($productos as $producto)
                          <option value="{{ $producto->productoid }}">{{ $producto->nombre }}</option>
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
  var ingresoId = $(this).data('ingresoid');
  var cantidad_ingresada = $(this).data('cantidad_ingresada');
  var productoid = $(this).data('productoid');
  
  var form = $('#modaleditar form');
  var actionUrl = "{{ route('ingresos.update', ['ingreso' => ':id']) }}".replace(':id', ingresoId);
  
  form.attr('action', actionUrl);
  $('#modaleditar #cantidad_ingresada').val(cantidad_ingresada);
  $('#modaleditar #productoid').val(productoid);

});
</script>
@endsection
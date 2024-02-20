@extends('layout.layout')
@section('content')
@auth
<h1 class="mb-5">Egresos</h1>
<table class="table">
  <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Cantidad Egresada</th>
        <th scope="col">Fecha</th>
        <th scope="col">Producto</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($egresos as $egreso)
    <tr>
      <th scope="row">{{ $egreso->egresoID }}</th>
      <td>{{ $egreso->cantidad_egresada }}</td>
      <td>{{ $egreso->created_at }}</td> 
      <td>{{ $egreso->producto->nombre }}</td>
      <td>
        <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#modaleditar" 
        data-egresoid="{{ $egreso->egresoID }}" 
        data-cantidad_egresada="{{ $egreso->cantidad_egresada }}"
        data-productoid="{{ $egreso->productoid }}">Editar</button>        
      </td>
      <td>
        <form action="{{ route('egresos.destroy', ['egreso'=>$egreso->egresoID]) }}" method="POST">
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
        <h5 class="modal-title">Agregar Egreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('egresos.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="cantidad_egresada" class="form-label">Cantidad Egresada</label>
            <input type="text" class="form-control" id="cantidad_egresada" name="cantidad_egresada" required>
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
        <h5 class="modal-title">Editar Egreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-proveedor="Close"></button>
      </div>
      <form method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="cantidad_egresada" class="form-label">Cantidad Egresada</label>
            <input type="text" class="form-control" id="cantidad_egresada" name="cantidad_egresada" required>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$('.editBtn').click(function(){
    var egresoId = $(this).data('egresoid');
    var cantidad_egresada = $(this).data('cantidad_egresada');
    var productoid = $(this).data('productoid');
    
    var form = $('#modaleditar form');
    var actionUrl = "{{ route('egresos.update', ['egreso' => ':id']) }}".replace(':id', egresoId);
    
    form.attr('action', actionUrl);
    $('#modaleditar #cantidad_egresada').val(cantidad_egresada);
    $('#modaleditar #productoid').val(productoid);

});
});
</script>
@endauth
@endsection
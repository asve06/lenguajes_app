@extends('layout.layout')

@section('content')
<h1 class="mb-5">Categorias</h1>

<table class="table">
  <thead>
    <tr>
      <th class="col-1" scope="col">Id</th>
      <th class="col-3" scope="col">Nombre</th>
      <th scope="col">Detalles</th>
      <th class="col-1" scope="col">Editar</th>
      <th class="col-1" scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($labels as $label)
    <tr>
      <th scope="row">{{ $label->labelID }}</th>
      <td>{{ $label->name }}</td>
      <td>{{ $label->details }}</td>
      <td>
        <button class="btn btn-primary editLabelBtn" data-bs-toggle="modal" data-bs-target="#modaleditar"
                data-labelid="{{ $label->labelID }}" 
                data-name="{{ $label->name }}" 
                data-details="{{ $label->details }}">Editar</button>
      </td>
      <td>
        <form action="{{ route('labels.destroy', ['label' => $label->labelID]) }}" method="POST">
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
        <h5 class="modal-title">Add Label</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('labels.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="details" class="form-label">Detalles</label>
            <input type="text" class="form-control" id="details" name="details" required>
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

<!-- Edit -->
<div class="modal" id="modaleditar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Label</h5>
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
            <label for="details" class="form-label">Detalles</label>
            <input type="text" class="form-control" id="details" name="details" required>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('.editLabelBtn').click(function(){
    var labelId = $(this).data('labelid');
    var name = $(this).data('name');
    var details = $(this).data('details');
    
    var form = $('#modaleditar form');
    var actionUrl = "{{ route('labels.update', ['label' => ':id']) }}".replace(':id', labelId);
    
    form.attr('action', actionUrl);
    $('#modaleditar #name').val(name);
    $('#modaleditar #details').val(details);
  });
});
</script>

@endsection

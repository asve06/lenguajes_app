@extends('layout.layout')
@section('content')
  <h1 class="mb-5">Productos</h1>
  @yield('content')
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
          <th scope="row">{{ $producto->productoID }}</th>
          <td>{{ $producto->nombre }}</td>
          <td>{{ $producto->precio }}</td>
          <td>{{ $producto->descripcion }}</td>
          <td>{{ $producto->existencia_actual }}</td>  
          <td>{{ $producto->categoria->nombre}}</td>
          <td>{{ $producto->proveedor->nombre}}</td>
          <td>
            <a href="{{ route('productos.edit', ['producto'=>$producto->productoID]) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaleditarp">Editar</a>
          </td>
          <td>
            <form action="{{ route('productos.destroy', ['producto'=>$producto->productoID]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">x</button>
            </form>
          </td>
        </tr>
      @endforeach
      <tr>
        <th scope="row">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcrearp">+</button>
        </th>
      </tr>
    </tbody>
  </table>
  <div class="modal" id="modalcrearp" tabindex="-1">
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
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="text" class="form-control" id="precio" name="precio">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="mb-3">
              <label for="existencia_actual" class="form-label">Existencia actual</label>
              <input type="text" class="form-control" id="existencia_actual" name="existencia_actual">
            </div>
            <div class="mb-3">
              <label for="categoriaID" class="form-label">Categoría</label>
              <select class="form-select" id="categoriaID" name="categoriaID">
                  <option value="">Selecciona una categoría</option>
                  @foreach ($categorias as $categoria)
                      <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                  @endforeach
              </select>
            <div class="mb-3">
              <label for="proveedorID" class="form-label">Proveedor</label>
              <input type="text" class="form-control" id="proveedorID" name="proveedorID">
            </div>
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
  <div class="modal" id="modaleditarp" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('productos.update',['producto'=>$producto->productoID]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input value="{{$producto->nombre ?? 'No encontrado'}}" type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input value="{{$producto->precio ?? 'No encontrado'}}" type="text" class="form-control" id="precio" name="precio">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <input value="{{$producto->descripcion ?? 'No encontrado'}}" type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="mb-3">
              <label for="existencia_actual" class="form-label">Existencia actual</label>
              <input value="{{$producto->existencia_actual ?? 'No encontrado'}}" type="text" class="form-control" id="existencia_actual" name="existencia_actual">
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

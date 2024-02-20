@extends('layout.layout')
@section('content')
@auth
<div class="col-6 row mx-auto my-1">
  <h1>Tu cuenta</h1>
  <div class="card mb-4">
    <div class="card-body text-center">
      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
        class="rounded-circle img-fluid mb-3" style="width: 150px;">
      <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="username" class="form-label">Nombre</label>
          <input value="{{$user->username}}" type="text" class="form-control col-3" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input value="{{$user->email}}" type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Cambiar Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="d-flex justify-content-center mb-2">
          <button type="submit" class="btn btn-outline-primary ms-1">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endauth
@endsection
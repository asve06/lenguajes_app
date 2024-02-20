@extends('layout.layout')
@section('content')
<div class="col-20">
  <h1>Tu cuenta</h1>
  @auth
  <div class="mb-3">
    <label for="Username" class="form-label">Nombre</label>
    <input value="{{$user->username}}" type="text" class="form-control" id="Username" name="Username" required>
  </div>
  <div class="mb-3">
      <label for="apellido" class="form-label">Apellido</label>
      <input value="{{$user->email}}" type="text" class="form-control" id="apellido" name="apellido" required>
  </div>
  <div class="mb-3">
      <label for="numero" class="form-label">Número</label>
      <input value="{{$user->password}}" type="password" class="form-control" id="numero" name="numero" required>
  </div>
  @endauth
</div>
@endsection
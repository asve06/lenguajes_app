@extends('layout.layout')
@section('content')
<div class="col-20">
  <h1>Home</h1>
  @auth
    <p>Welcome, {{$username}}</p>
    <p><a href="/logout">Logout</a></p>
  @endauth
  @guest
    <p>Para ver el contenido <a href="/login">inicia sesion</a></p>
  @endguest
</div>
@endsection
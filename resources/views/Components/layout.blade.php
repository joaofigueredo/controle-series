<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <title>{{ $title }}</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link link-light" href="{{route('series.index')}}">Home</a>
        </li>
        @auth
        <li class="nav-item">
          <a class="nav-link link-light mb-2" href="{{route('series.create')}}">Adicionar Série</a>
        </li>
        @endauth
      </ul>
      @auth
      <form action="{{ route('logout') }}">
        <button class="btn btn-primary mb-2">
          Sair
        </button>
      </form>
      @endauth

      @guest
      <a href="{{ route('login') }}" class="nav-link link-light">Entrar</a>
      @endguest
    </div>
  </nav>
  <div class="container">
    <h1>{{ $title }}</h1>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
      {{ $mensagemSucesso }}
    </div>
    @endisset

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {{$slot}}
  </div>

  <footer class="bg-body-tertiary text-center text-lg-start sticky-top">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 Copyright:
      <a class="text-body" href="https://github.com/joaofigueredo" target="_blank">
        joaoFigueredo
      </a>
    </div>
  </footer>

</body>

</html>
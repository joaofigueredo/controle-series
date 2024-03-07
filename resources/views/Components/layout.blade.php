<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{ $title }}</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark - bg-primary">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('series.index')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('series.create')}}">Adicionar Série</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="container">
        <h1>{{ $title }}</h1>

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

</body>
</html>
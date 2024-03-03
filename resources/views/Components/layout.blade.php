<!DOCTYPE html>
<html lang="en">
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
        <a class="nav-link" href="/series/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/series/criar">Adicionar Série</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="container">
        <h1>{{ $title }}</h1> 

        {{$slot}}
    </div>

</body>
</html>
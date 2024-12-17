<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titre ?? ''}}</title>
    <meta name="description" content="{{$description ?? ''}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Cvthèque</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="/">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('professionnels.index')}}">Professionnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('metiers.index')}}">Metiers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('competences.index')}}">Compétences</a>
        </li>
      </ul>
      <form class="d-flex" action="{{ route('professionnels.index') }}" method="GET">
        <input class="form-control me-sm-2" type="search" name="search" placeholder="Rechercher un pro..." value="{{ request('search') }}">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
    </div>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/share-modal.js') }}"></script>   
@yield('contenu')
</body>
</html> 
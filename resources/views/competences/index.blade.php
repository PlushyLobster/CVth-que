{{-- Directives de Blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Définition de la section "contenu" de la vue cvtheque  
Lien réalisé avec la directive @yeld() --}}
@section('contenu')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Compétences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .create-button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .create-button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<hr/>
<div class="container">
  
    @if(session('information'))
    <div class="bs-docs-section pos-bloc-section">    
        <div class="alert alert-dismissible alert-success">        
            <h4 class="alert-heading">Information : </h4>        
        <p class="mb-0">{{session('information')}}</p>    
        </div>
    </div>
    @endif
    <div class="header">
        <h1>Liste des Compétences</h1>
        <a href="{{route("competences.create")}}" class="btn btn-info">Créer une Compétence</a>
    </div>
    {{-- <form action="{{ route('competences.index') }}" method="GET" class="mb-4">
        <div>
            <label for="search">Rechercher une compétence :</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Ex : Développement">
        </div>
        <button type="submit" class="btn btn-secondary">Rechercher</button>
    </form> --}}
    <form action="{{ route('competences.index') }}" method="GET" class="mb-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher une compétence" aria-describedby="button-addon2" id="search"  name="search" value="{{ request('search') }}" placeholder="Ex : Développement">
            <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
        </div>
    </form>
    @if($competences->isEmpty())
    <p>Aucune compétence ne correspond à votre recherche.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <!-- Exemple de données -->
            @foreach($competences as $competence)

            <tr>
                <td>{{$competence->id}}</td>
                <td>{{$competence->intitule}}</td>
                <td>
                    <form action="{{route('competences.show', $competence->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">Consulter</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('competences.edit', $competence->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-warning">Modifier</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('competences.destroy', $competence->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            {{-- <td>{{$competence->description}}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <footer class="pagination justify-content-center p-lg-5">
        {{$competences->links()}}
    </footer>
</div>
@endif
</body>
</html>
@endsection
{{-- Fin de la section "contenu" --}}
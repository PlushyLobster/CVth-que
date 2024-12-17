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
    <title>Tableau des Professionnels</title>
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
    <form action="{{ route('professionnels.index', $slug) }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" 
                       placeholder="Rechercher par nom ou prénom..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-5">
                <input type="text" name="competence" class="form-control" 
                       placeholder="Rechercher par compétence..." 
                       value="{{ request('competence') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>
        <!-- Message si une recherche a été effectuée -->
    @if(request('search'))
        <p>Résultats pour : <strong>{{ request('search') }}</strong></p>
    @endif

    <!-- Message si aucune donnée trouvée -->
    @if($professionnels->isEmpty())
        <div class="alert alert-warning">
            Aucun professionnel ne correspond à votre recherche.
        </div>
    @else

    @if(session('information'))
    <div class="bs-docs-section pos-bloc-section">    
        <div class="alert alert-dismissible alert-success">        
            <h4 class="alert-heading">Information : </h4>        
        <p class="mb-0">{{session('information')}}</p>    
        </div>
    </div>
    @endif
    <div class="header">
        <h1>Liste des Professionnels</h1>
        <a href="{{route("professionnels.create")}}" class="btn btn-info">Créer un Professionnel</a>
    </div>
    <select onchange="location.href=this.value">
        <option value="{{route('professionnels.index')}}" @unless($slug) selected @endunless>
            Tous les professionnels
        </option>
        @foreach($metiers as $metier)
            <option value="{{route('professionnels.metier', ['slug'=>$metier->slug])}}"
                {{($slug == $metier->slug) ? 'selected' : ''}}>
                {{$metier->libelle}}
            </option>
        @endforeach
    </select>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom et Prénom</th>
                <th>Intitulé</th>
                <th>Domiciliation</th>
                <th>Formation</th>
                <th>CV</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <!-- Exemple de données -->
            @forelse($professionnels as $professionnel)

            <tr>
                <td>{{$professionnel->id}}</td>
                <td>{{$professionnel->prenom}} {{$professionnel->nom}}</td>
                <td>{{$professionnel->metier->intitule}}</td>
                <td>{{$professionnel->cp}} {{$professionnel->ville}}</td>
                <td>@if($professionnel->formation==0) NON @else OUI @endif</td>
                <td>
                @if($professionnel->cv)
                    <a href="{{ asset('storage/cvs/' . $professionnel->cv) }}" target="_blank" class="btn btn-info">
                        Télécharger le CV
                    </a>
                @else
                    <span>Aucun CV disponible</span>
                @endif
                </td>
                <td>
                    <form action="{{route('professionnels.show', $professionnel->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">Consulter</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('professionnels.edit', $professionnel->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-warning">Modifier</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('professionnels.destroy', $professionnel->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Aucun professionnel correspondant à votre demande n'a été trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <footer class="pagination justify-content-center p-lg-5">
        {{ $professionnels->appends(['search' => request('search')])->links() }}
    </footer>
    @endif
</div>

</body>
</html>
@endsection

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
    <title>Tableau des Métiers</title>
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
        <h1>Liste des Métiers</h1>
        <a href="{{route("metiers.create")}}" class="btn btn-info">Créer un Métier</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Libelle</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <!-- Exemple de données -->
            @foreach($metiers as $metier)

            <tr>
                <td>{{$metier->id}}</td>
                <td>{{$metier->libelle}}</td>
                <td>
                    <form action="{{route('metiers.show', $metier->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">Consulter</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('metiers.edit', $metier->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-warning">Modifier</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('deleteform', $metier->id)}}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
@endsection

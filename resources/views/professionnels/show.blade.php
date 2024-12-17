@extends('cvtheque')

@section('contenu')


    <style>
        form {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea, button {
            width: 100%;
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            cursor: pointer;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        .button-container button {
            width: 48%;
        }
    </style>


<form @readonly(true)>
    <label for="metier_id">Métier</label>
    <input type="text" id="metier_id" name="metier_id" readonly value={{$professionnel->metier->libelle}}>
    <label for='competence_id'>Compétences</label>
    @forelse($professionnel->competences as $competence)
        - {{$competence->intitule}}<br>
    @empty
        - Aucune compétence associée
    @endforelse
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" readonly value={{$professionnel->nom}}>
    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" readonly value={{$professionnel->prenom}}>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" readonly value={{$professionnel->email}}>
    <label for="telephone">Téléphone</label>
    <input type="text" id="telephone" name="telephone" readonly value={{$professionnel->telephone}}>
    <label for="domicile">Domicile</label>
    <input type="text" id="domicile" name="domicile" readonly value={{$professionnel->cp}}{{$professionnel->ville}}>
    <label for="naissance">Date de naissance</label>
    <input type="text" id="naissance" name="naissance" readonly value={{$professionnel->naissance}}>
    <label for="formation">Formation</label>
    <input type="text" id="formation" name="formation" readonly value={{$professionnel->formation}}>
    <label for="domaine">Domaine</label>
    @if(is_array($professionnel->domaine) && in_array('S', $professionnel->domaine))
        - Systèmes<br>
    @endif &nbsp;
    @if(is_array($professionnel->domaine) && in_array('R', $professionnel->domaine))
        - Réseaux<br>
    @endif &nbsp;
    @if(is_array($professionnel->domaine) && in_array('D', $professionnel->domaine))
        - Développement<br>
    @endif &nbsp;

    @if($professionnel->cv)
        <a href="{{ asset('storage/cvs/' . $professionnel->cv) }}" target="_blank" class="btn btn-info">
            Télécharger le CV
        </a>
    @else
        <span>Aucun CV disponible</span>
    @endif

    

    <div class="button-container">
        <button type="button" onclick="window.history.back();">Retour</button>
    </div>
</form>

@endsection
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


<form action="{{ route('professionnels.update', $professionnel->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="metier_id">Métier</label>
    <select id="metier_id" name="metier_id" class="form-control">
        @foreach($metiers as $metier)
            <option value="{{ $metier->id }}" {{ $metier->id == $professionnel->metier_id ? 'selected' : '' }}>
                {{ $metier->libelle }}
            </option>
        @endforeach
    </select>

    <label for="competence_id">Compétences</label>
    <select id="competence_id" name="competence_id[]" class="form-control" multiple>
        @foreach($competences as $competence)
            <option value="{{ $competence->id }}"
                {{ in_array($competence->id, old('competence_id', $professionnel->competences->pluck('id')->toArray())) ? 'selected' : '' }}>
                {{ $competence->intitule }}
            </option>
        @endforeach
    </select>
    @error('competence_id')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" class="@error('nom') is-invalid @enderror" value={{old('nom', $professionnel->nom)}}> 
    @error('nom')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror 

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" class="@error('prenom') is-invalid @enderror" value={{old('prenom',$professionnel->prenom)}}>
    @error('prenom')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror

    <label for="email">Email</label>
    <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" value={{old('email', $professionnel->email)}}>
    @error('email')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
 
    <label for="telephone">Téléphone</label>
    <input type="text" id="telephone" name="telephone" class="@error('telephone') is-invalid @enderror" value={{old('telephone', $professionnel->telephone)}}>
    @error('telephone')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    
    
    <label for="cp">Code Postal</label>
    <input type="text" id="cp" name="cp" class="@error('cp') is-invalid @enderror" value={{old('cp', $professionnel->cp)}}>
    @error('cp')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" class="@error('ville') is-invalid @enderror" value={{old('ville', $professionnel->ville)}}>
    @error('ville')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    
    <label for="naissance">Date de naissance</label>
    <input type="text" id="naissance" name="naissance" class="@error('naissance') is-invalid @enderror" value={{old('naissance', $professionnel->naissance)}}>
    @error('naissance')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    
    <label for="formation">Formation</label>
    <input type="text" id="formation" name="formation" class="@error('formation') is-invalid @enderror" value={{old('formation', $professionnel->formation)}}>
    @error('formation')
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    
    <label for="domaine">Domaine</label>
    <input type="checkbox" id="domaine" name="domaine[]"  value="S"
    {{(is_array(old('domaine', $professionnel->domaine)) && in_array('S', old('domaine', $professionnel->domaine))) ? 'checked': ''}}>
    <label class="@error('domaine') @enderror">Système</label>
    <input type="checkbox" id="domaine" name="domaine[]"  value="R"
    {{(is_array(old('domaine', $professionnel->domaine)) && in_array('R', old('domaine', $professionnel->domaine))) ? 'checked': ''}}>
    <label class="@error('domaine') @enderror">Réseau</label>
    <input type="checkbox" id="domaine" name="domaine[]"  value="D"
    {{(is_array(old('domaine', $professionnel->domaine)) && in_array('D', old('domaine', $professionnel->domaine))) ? 'checked': ''}}>
    <label class="@error('domaine') @enderror">Développement</label>

    {{--
    <label for="source">Source</label>
    <input type="text" 
        id="source" 
        name="source" 
        class="form-control "
        value={{old('source',$professionnel->source )}}>



    <label for="observation">Observation</label>
    <textarea id="observation" 
        name="observation" 
        class="form-control" 
        rows="5" >{{old('observation', $professionnel->observation)}}
    </textarea>
 --}}

    <div class="button-container">
        <a href={{route('professionnels.index')}} class="btn btn-primary">Retour</a>
        <button type="submit" class="btn btn-success float-end">Modifier</button>
    </div>
</form> 

@endsection
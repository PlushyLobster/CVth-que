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


<form method="POST" action="{{route('professionnels.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <label for="metier_id">Métier</label>
    <select name="metier_id" @error('metier_id') is-invalid @enderror>
        <option value=""@if(old('metier_id')=="") selected @endif>Choisir un métier</option>
        @foreach($metiers as $metier)
            <option value="{{$metier->id}}" @if(old('metier_id') == $metier->id) selected @endif>{{$metier->libelle}}</option>
        @endforeach
    </select>
    @error('metier_id')
        <p class="text-danger" role="alert">
            {{$message}}
        </p>
    @enderror
        
    <label for="competence_id">Compétence</label>
    <select name="competence_id[]" @error('competence_id') is-invalid @enderror  multiple >
        <option value=""@if(old('competence_id')=="") selected @endif>Choisir une ou plusieurs compétence</option>
        @foreach($competences as $competence)
            <option value="{{$competence->id}}" {{(collect(old("competence_id"))->contains($competence->id))?'selected':""}}>{{$competence->intitule}}</option>
        @endforeach
    </select>

    @error('competence_id')
        <p class="text-danger" role="alert">
            {{$message}}
        </p>
    @enderror

    <label for="nom">Nom</label>
    <input type="text" 
        id="nom" 
        name="nom" 
        class="form-control @error('nom') is-invalid @enderror" 
        value="{{old('nom')}}">
        @error('nom')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror
    
    <label for="prenom">Prénom</label>
    <input type="text" 
        id="prenom" 
        name="prenom" 
        class="form-control @error('prenom') is-invalid @enderror" 
        value="{{old('prenom')}}">
        @error('prenom')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror
    
    <label for="email">Email</label>
    <input type="email" 
        id="email" 
        name="email" 
        class="form-control @error('email') is-invalid @enderror" 
        value="{{old('email')}}">
        @error('email')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror
    
    <label for="telephone">Téléphone</label>
    <input type="text" 
        id="telephone" 
        name="telephone" 
        class="form-control @error('telephone') is-invalid @enderror" 
        value="{{old('telephone')}}">
        @error('telephone')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    
    <label for="cp">Code Postal</label>
    <input type="text" 
        id="cp" 
        name="cp" 
        class="form-control @error('cp') is-invalid @enderror" 
        value="{{old('cp')}}">
        @error('cp')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    <label for="ville">Ville</label>
    <input type="text" 
        id="ville" 
        name="ville" 
        class="form-control @error('ville') is-invalid @enderror" 
        value="{{old('ville')}}">
        @error('ville')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror
    {{-- date de naissance --}}
    <label for="naissance">Date de naissance</label>
    <input type="date" 
        id="naissance" 
        name="naissance" 
        class="form-control @error('naissance') is-invalid @enderror" 
        value="{{old('naissance')}}">
        @error('naissance')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    {{-- formation en bouton radio --}}
    <label for="formation">Formation</label>
    <div>
        <input type="radio" 
            id="formation" 
            name="formation" 
            value="1" 
            @if(old('formation') == 1) checked @endif>
        <label for="formation">Oui</label>
    </div>
    <div>
        <input type="radio" 
            id="formation" 
            name="formation" 
            value="0" 
            @if(old('formation') == 0) checked @endif>
            <label for="formation">Non</label>
    </div>
    @error('formation')
        <p class="text-danger" role="alert">
            {{$message}}
        </p>
    @enderror

    <div class="form-group mb-2">    
        <label class="col-form-label" for="domaine">Domaine de formation possible : </label>    
        <div class="form-check">        
            <input type="checkbox" class="form-check-input" id="domaine1" name="domaine[]" value="S"{{ (is_array(old('domaine')) && in_array('S', old('domaine'))) ? ' checked' : '' }}>       
             <label class="form-check-label @error('domaine') text-danger @enderror" for="domaine1">Systèmes</label>    
            </div>    
            <div class="form-check">       
                 <input type="checkbox" class="form-check-input" id="domaine2" name="domaine[]" value="R"{{ (is_array(old('domaine')) && in_array('R', old('domaine'))) ? ' checked' : '' }}>
                 <label class="form-check-label @error('domaine') text-danger @enderror" for="domaine2">Réseaux</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="domaine3" name="domaine[]" value="D"{{ (is_array(old('domaine')) && in_array('D', old('domaine'))) ? ' checked' : '' }}>
                <label class="form-check-label @error('domaine') text-danger @enderror" for="domaine3">Développement</label>    
        </div>   
    @error('domaine')    
        <p class="text-danger" role="alert">{{$message}}</p>   
    @enderror</div> 

    <label for="cv">CV (format PDF uniquement)</label>
    <input type="file" id="cv" name="cv" class="form-control @error('cv') is-invalid @enderror" accept="application/pdf">
    
    @error('cv')
        <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    
    <label for="source">Source</label>
    <input type="text" 
        id="source" 
        name="source" 
        class="form-control "
        value={{old('source')}}>

    {{-- metier en select --}}

    <label for="observation">Observation</label>
    <textarea id="observation" 
        name="observation" 
        class="form-control" 
        rows="5" >{{old('observation')}}</textarea>

    <div class="button-container">
        <a href={{route('professionnels.index')}} class="btn btn-primary">Retour</a>
        <button type="submit" class="btn btn-success float-end">Créer</button>
    </div>
</form>
@endsection
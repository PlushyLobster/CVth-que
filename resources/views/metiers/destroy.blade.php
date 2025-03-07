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


<form method="POST" action="{{route('metiers.destroy', ['metier'=>$metier->id])}}">
    @method('DELETE')
    @csrf

    <label for="libelle">Libelle</label>
    <input type="text" 
        id="libelle" 
        name="libelle" 
        class="form-control @error('libelle') is-invalid @enderror" 
        value={{old('libelle', $metier->libelle)}}
        @disabled(true)>
        @error('libelle')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    <label for="description">Description</label>
    <textarea id="description" 
        name="description" 
        class="form-control @error('description') is-invalid @enderror" 
        rows="5" >{{old('description', $metier->description)}}  @disabled(true) </textarea>
        @error('description')
        <p class="text-danger" role="alert">
            {{$message}}
        </p>
    @enderror

    <label for="slug">Slug</label>
    <input type="text" 
        id="slug" 
        name="slug" 
        class="form-control @error('slug') is-invalid @enderror" 
        value={{old('slug', $metier->slug)}}
        @disabled(true)>
        @error('slug')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    <div class="button-container">
        <a href="{{route('metiers.index')}}" class="btn btn-primary">Retour</a>
        <button type="submit" class="btn btn-danger float-end">Supprimer</button>
    </div>
</form>

@endsection
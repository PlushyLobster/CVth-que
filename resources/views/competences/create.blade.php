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


<form method="POST" action="{{route('competences.store')}}">
    @method('POST')
    @csrf

    <label for="intitule">Intitulé</label>
    <input type="text" 
        id="intitule" 
        name="intitule" 
        class="form-control @error('intitule') is-invalid @enderror" 
        value={{old('intitule')}}>
        @error('intitule')
            <p class="text-danger" role="alert">
                {{$message}}
            </p>
        @enderror

    <label for="description">Description</label>
    <textarea id="description" 
        name="description" 
        class="form-control @error('description') is-invalid @enderror" 
        rows="5" >{{old('description')}}</textarea>
        @error('description')
        <p class="text-danger" role="alert">
            {{$message}}
        </p>
    @enderror

    <div class="button-container">
        <a href="{{route('competences.index')}}" class="btn btn-primary">Retour</a>
        <button type="submit" class="btn btn-success float-end">Créer</button>
    </div>
</form>

@endsection
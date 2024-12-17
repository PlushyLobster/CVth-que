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
    <label for="intitule">Intitulé</label>
    <input type="text" id="intitule" name="intitule" readonly value={{$competence->intitule}}>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5" readonly >{{$competence->description}}</textarea>

    <div class="button-container">
        <button type="button" onclick="window.history.back();">Retour</button>
    </div>
</form>

@endsection
@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{$sujet->titre}}</h1>
    <hr>
    <form action="{{route('sujets.update', $sujet)}}" method="POST">
    @csrf 
    @method('PATCH')
        <div class="form-group">
            <label for="titre">Titre : </label>
            <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" id="titre" value ="{{$sujet->titre}}"></input>
            @error('titre')
            <div class="invalid-feedback">{{$errors->first('titre')}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contenu">Lien Url: </label>
            <textarea class="form-control @error('contenu') is-invalid @enderror" name="contenu" id="contenu">{{$sujet->contenu}}</textarea>
            @error('contenu')
            <div class="invalid-feedback">{{$errors->first('contenu')}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"> Modifier le sujet </button>  
    </form> 
</div>

@endsection
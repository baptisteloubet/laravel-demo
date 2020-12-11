@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> {{$sujet->titre}}</h5>
            <p>{{$sujet->contenu}}</p>
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $sujet ->created_at->format('d/m/y à H:m')}}</small>
                <span class="badge badge-primary">{{$sujet->user->name}}</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-2">
        @can('update', $sujet)
            <div class="mr-1">
                <a href="{{route('sujets.edit', $sujet)}}" class="btn btn-warning">Editer le sujet</a>
            </div>
        @endcan
        @can('delete', $sujet)
        <form action="{{route('sujets.destroy', $sujet)}}" method="POST"> 
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        @endcan
    </div>
    <hr>
    <h5>Commentaires</h5>
    @forelse($sujet->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                {{$comment->contenu }}
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $comment ->created_at->format('d/m/y ')}}</small>
                    <span class="badge badge-primary">{{$comment->user->name}}</span>
                    <form action="{{route('comments.destroy', $sujet)}}" method="POST"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

    @empty

        <div class="alert alert-info">Aucun Commentaire pour ce sujet</div>

    @endforelse

    <form action ="{{route('comments.store', $sujet)}}" method="POST" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="content">Votre commentaire </label>
            <textarea class="form-control @error ('contenu') is-invalid @enderror" name="contenu" id="contenu" row="5"></textarea> 
            @error('content')
                <div class="invalid-feedback">{{$errors->first('contenu')}}
            @enderror
        </div>
        <div class="d-flex justify-content-center mt-2">
            <button type="submit" class="btn btn-primary">Soumettre mon commentaire</button>
        </div>
            </div>
    </form>
 
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> {{$sujet->titre}}</h5>
            <p><a href="{{$sujet->contenu}}">{{$sujet->contenu}}</a></p>
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $sujet ->created_at->format('d/m/y à H:m')}}</small>
                <span class="badge badge-primary">Posté par {{$sujet->user->name}}</span>
            </div>
        </div>
    </div>
    <hr>
    <h5>Commentaires ({{count($sujet->comments)}})</h5>

    @forelse($sujet->comments as $comment)

        <div class="card mb-2">
            <div class="card-body">
                {{$comment->contenu }}
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $comment ->created_at->format('d/m/y ')}} par {{$comment->user->name}}</small>
                    @can('delete', $comment)
                    <form action="{{route('comments.destroy', $comment)}}" method="POST"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    @endcan
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
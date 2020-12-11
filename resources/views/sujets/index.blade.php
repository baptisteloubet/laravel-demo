@extends('layouts.app')

@section('content')

<div class="container">
    <div class="list-group">

        @forelse($sujets as $sujet)

        <div class="list-group-item">
            <h4><a href="{{route('sujets.show', $sujet)}}">{{$sujet->titre}}</a></h4>
            <p><a href="{{$sujet->contenu}}">{{$sujet->contenu}}</a></p>
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $sujet ->created_at->format('d/m/y')}} |  {{count($sujet->comments)}} commentaires </small>
                <span class="badge badge-primary">Posté par {{$sujet->user->name}}</span>
            </div>
        </div>

        @empty

        <div class="alert alert-info">Aucun Post n'a été publié</div>

        @endforelse
        
    </div>
</div>

@endsection
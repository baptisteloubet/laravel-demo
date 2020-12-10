@extends('layouts.app')

@section('content')

<div class="container">
    <div class="list-group">
        @foreach($sujets as $sujet)
        <div class="list-group-item">
            <h4><a href="{{route('sujets.show', $sujet)}}">{{$sujet->title}}</a></h4>
            <p>{{$sujet->title}}</p>
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $sujet ->created_at->format('d/m/y à H:m')}}</small>
                <span class="badge badge-primary">{{$sujet->user->name}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
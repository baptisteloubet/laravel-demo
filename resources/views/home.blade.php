@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mes posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach (Auth()->user()->sujets as $sujet)
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-center ">
                                    <div class="pt-3">
                                        "{{$sujet->titre}}" a été créé le {{Carbon\Carbon::parse
                                        ($sujet->created_at)->format('d/m/y')}}
                                    </div>
                                    <div class="ml-2 pt-2">
                                        
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <div class="mr-1">
                                            <a href="{{route('sujets.show', $sujet)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        </div>
                                        <div class="mr-1">
                                            <a href="{{route('sujets.edit', $sujet)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <form action="{{route('sujets.destroy', $sujet)}}" method="POST"> 
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

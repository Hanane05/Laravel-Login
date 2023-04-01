@extends('layouts.app')
@section('title', 'Liste des étudiants')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center p-5">

            <div class="card-header">
                <div class="display-5 m-2">
                    {{ config('app.name')}}
                </div>
                <a href="{{route('etudiant.create')}}" class="btn btn-success">Ajouter Étudiant</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 list-group  mb-5  w-75">
            @forelse($etudiants as $etudiant)
            <div class="list-group-item list-group-item-action d-flex justify-content-between">
                <a href="{{ route('etudiant.show',  $etudiant->id)}}" class="text-decoration-none">{{ $etudiant->nom}}</a>
                <a href="{{ route('etudiant.edit',  $etudiant->id)}}">modifier</a>
            </div>

            @empty
            <p>Aucun étudiant disponible</p>

            @endforelse
        </div>
        <div class="w-75">
            {{$etudiants}}
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
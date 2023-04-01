@extends('layouts.app')
@section('title', 'Étudiant info')
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center pt-2">
            <div class="display-5 mt-2">
                {{ config('app.name')}}
            </div>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    {{session('success')}}
                </strong>
                <button type="button
                " class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    <div class="col-12  d-flex flex-column align-items-center">
        <ul class="list-group list-group-flush w-75">
            <li class="list-group-item"><strong>Nom: </strong>{{$etudiant->nom}}</li>
            <li class="list-group-item"><strong>Adresse :</strong> {{ $etudiant->adresse }}</li>
            <li class="list-group-item"> <strong>Téléphone : </strong> {{$etudiant->phone}}</li>
            <li class="list-group-item"><strong>Date de naissance : </strong> {{$etudiant->date_de_naissance}}</li>
            <li class="list-group-item"><strong>Ville: </strong> {{$ville}}</li>
        </ul>

        <div class="w-75 d-flex gap-3 mt-5">
            <a href="{{route('etudiant.index')}}" class="btn  btn-primary btn-sm">Retourner</a>
            <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-success btn-sm ">Mettre à jour</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Supprimer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Effacer l'article</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Etes-vous sur de supprimer l'étudiant: {{ $etudiant->nom}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="{{ route('etudiant.delete', $etudiant->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Supprimer">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
@endsection
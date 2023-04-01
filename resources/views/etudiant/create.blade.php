@extends('layouts.app')
@section('title', 'Étudiant info')
@section('content')
<div class="container">
    <div class="row">
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
        <div class="col-md-6 m-auto mt-3">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li class="text-danger">{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-center">
                <form method="POST" action="{{route('etudiant.store')}}" class=" mt-5 w-50 ">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{old('nom')}}">
                    </div>

                    <div class=" mb-3">
                        <label for="email" class="form-label">Courriel:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="{{old('adresse')}}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    </div>

                    <div class="mb-3">
                        <label for="date_de_naissance" class="form-label">Date de naissance:</label>
                        <input type="date" class="form-control" id="date_de_naissance" name="date_de_naissance" value="{{old('date_de_naissance')}}">
                    </div>

                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville:</label>
                        <select class="form-control" id="ville" name="ville_id">
                            <option value="" disabled selected>Choississez une ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->id}}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter</button>

                </form>
            </div>


            @endsection
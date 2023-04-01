@extends('layouts.app')
@section('title', 'Add a file')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <h1 class="display-5">
                    @lang('lang.addFile')
                </h1>
            </div> <!--/col-12-->
        </div><!--/row-->
                <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                <div class="card">
                    <form  action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            Formulaire
                        </div>
                        <div class="card-body">  

                                <div class="col-12 mt-4">
                                    <label for="title">@lang('lang.titleFile')</label>
                                    <input type="text" id="title" name="titre" class="form-control" value="{{ old('titre') }}">
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <label for="title_fr">@lang('lang.titreFichier')</label>
                                    <input type="text" id="title_fr" name="titre_fr" class="form-control" value="{{ old('titre_fr') }}">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="file">Sélectionnez un fichier :</label>
                                    <input type="file" name="fichier" id="file" accept=".pdf,.doc,.zip">
                                </div>

                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-success" value="@lang('lang.save')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div><!--/container-->

@endsection



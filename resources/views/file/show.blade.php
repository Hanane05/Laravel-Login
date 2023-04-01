@extends('layouts.app')
@section('title', 'Fichier')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <div class="display-5 mt-2">
                    {{ config('app.name')}}
                </div>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="display-6 mt-2">
                    @if( session()->get('locale') == 'fr' )
                        {{$file->titre_fr}}
                    @else
                        {{$file->titre}}
                    @endif
                </div>
                <div class="mt-2">
                    <a href="{{$file->fichier}}" target="_blank">@lang('lang.download')</a>
                </div>
                
                <p>
                    <em>Author : </em>
                    {{$file->author}}
                </p>
                
                <a href="{{route('file.index')}}" class="btn btn-sm btn-primary">@lang('lang.return')</a>
            </div>
        </div>

        @if( Auth::user()->id == $file->etudiant_id )
        <div class="row mt-2">
            <hr>
            <div class="col-6">
                <a href="{{ route('file.edit', $file->id)}}" class="btn btn-success btn-sm">@lang('lang.update')</a>
            </div>
            <div class="col-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                @lang('lang.delete')
                </button>
                
            </div>
        </div>
        @endif

    </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.deleteArticle')</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">@lang('lang.deleteMessageFile')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.dismiss')</button>
        <form action="{{ route('file.delete', $file->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="Supprimer">
         </form>
      </div>
    </div>
  </div>
</div>

@endsection
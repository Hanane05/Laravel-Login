@extends('layouts.app')
@section('title', 'Files List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <div class="display-5 mt-2">
                @lang('lang.filesList')
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @lang('lang.filesList')
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse($files as $file)
                                <li class="d-flex justify-content-between">
                                    <a href="{{ route('file.show', ['file' => $file->id])}}">
                                    @if( session()->get('locale') == 'fr' )
                                    {{$file->titre_fr}}
                                    @else
                                    {{$file->titre}}
                                    @endif
                                    </a> <a href="{{$file->fichier}}" target="_blank">@lang('lang.download')</a></li>
                            @empty
                                <li>
                                @lang('lang.noFile')
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('file.create')}}" class="btn btn-success">@lang('lang.addFile')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
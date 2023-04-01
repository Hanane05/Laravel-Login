@extends('layouts.app')
@section('title', 'Articles List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <div class="display-5 mt-2">
                @lang('lang.welcome')
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @lang('lang.aList')
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse($articles as $article)
                                <li><a href="{{ route('article.show', $article->id)}}">
                                    @if( session()->get('locale') == 'fr' )
                                    {{$article->titre_fr}}
                                    @else
                                    {{$article->titre}}
                                    @endif
                                </a></li>
                            @empty
                                <li></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('article.create')}}" class="btn btn-success">@lang('lang.add')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
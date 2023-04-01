<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            {{-- session()->get('locale')--}}
            @php $lang = session()->get('locale') @endphp
            <a class="navbar-brand" href="{{ route('forum.index') }}">
                @lang('lang.hello')
                {{Auth::user() ? Auth::user()->name : "!"}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @guest
                    <a class="nav-link" href="{{route('user.signup')}}">@lang('lang.signup')</a>
                    <a class="nav-link" href="{{route('user.login')}}">@lang('lang.login')</a>
                    @else
                    @if( Auth::user()->role == 'admin' )
                    <a class="nav-link" href="{{route('etudiant.index')}}">@lang('lang.etudiant')</a>
                    @endif
                    <a class="nav-link" href="{{route('forum.index')}}">@lang('lang.forum')</a>
                    <a class="nav-link" href="{{route('file.index')}}">@lang('lang.files')</a>
                    <a class="nav-link" href="{{route('user.logout')}}">@lang('lang.logout')</a>
                    @endguest

                    <a class="nav-link @if($lang=='fr') text-info @endif" href="{{route('lang', 'fr')}}">Français <i class="flag flag-french-guiana"></i></a>

                    <a class="nav-link @if($lang=='en') text-info @endif" href="{{route('lang', 'en')}}">English <i class="flag flag-united-states"></i></a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>
@extends('layouts.app')
@section('title', 'Registration')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-header text-center">
                    <h3>@lang('lang.signup')</h3>
                </div>
                <form method="post">
                @csrf
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <input type="text" name="name" placeholder="@lang('lang.name')" class="form-control" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('name') }}
                                </div>                                
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" placeholder="@lang('lang.email')" class="form-control" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('email') }}
                                </div>                                
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" placeholder="@lang('lang.password')" class="form-control">
                            @if ($errors->has('password'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('password') }}
                                </div>                                
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                            <input type="submit" value="@lang('lang.save')" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
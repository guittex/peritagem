@extends('layouts.app')

@section('content')

<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<div class="container m-b-20">
    <!--col-xl-8 col-lg-8 col-md-8  col-sm-8 col-sm-offset-2 col-xl-offset-2 col-md-offset-2 col-lg-offset-2  m-b-20-->
    <div class="col-xl-10 col-lg-8 col-md-8 offset-lg-2 col-offset-md-1  m-b-20">
        <div class="panel-heading text-center" style="margin-bottom:10px">
            <h2>Faça o Login</h2>
        </div>
        <div class="col-xl-10 col-lg-8 col-md-8 offset-lg-2 col-offset-md-1  text-center">
            <img src="{!! asset('img/avatar.png') !!}" width=100 style="margin-bottom:40px">
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <div class="col-xl-10 col-lg-8 col-md-8 offset-lg-2 col-offset-md-1 ">
                    <input id="email" type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}" style="border: none;border-bottom: 1px solid gray;" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <div class="col-xl-8 col-lg-8 col-md-8 offset-lg-2 col-offset-md-1 ">
                    <input id="password" type="password" class="form-control" placeholder="Senha" style="border: none;border-bottom: 1px solid gray;"  name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" style="width:25%">
                        Login
                    </button>

                    <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>-->
                </div>
            </div>
        </form>    
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2 class="text-center">Olá {{auth::user()->name}}</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row text-center">
                        <h3 class="text-center" style="margin-bottom:40px">O que deseja fazer?!</h3>
                        <div class="col-md-6">
                            <a href="{{route('carros.index')}}" > <button class="btn btn-success" style="width:100%"> Peritagem</button> </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('user.sair')}}"><button class="btn btn-danger" style="width:100%"> Sair</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

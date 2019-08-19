@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <ol class="breadcrumb panel-heading">                    
                    <li><a href="{{ route('carros.index')}}" style=color:black>Equipamento</a></li>
                    <li class="active" style=color:white>Adicionar</li>
                </ol>

                <div class="panel-body">    
                    <form action="{{route('carros.atualizar', $registro->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name='id' value="{{  $registro->id  }}">

                        <div class="form-group">
                            <label for="Marca">Cliente</label>
                            <input type="text" name="marca" value="{{ $registro->marca }}" class="form-control" placeholder="Cliente">                                
                        </div>
                        <div class="form-group">
                            <label for="Modelo">NF</label>
                            <input type="text" name="modelo" value="{{ $registro->modelo }}" class="form-control" placeholder="Nf do produto">                               
                        </div>
                        <div class="form-group">    
                            <label for="Ano">Motivo</label>
                            <input type="text" name="ano" value="{{ $registro->ano }}" class="form-control" placeholder="Motivo da Peritagem">                                
                        </div>
                        @if(!empty($registro->imagem))
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Imagem">Imagem</label>
                                    <input type='file' id="imagem" value="{{ $registro->imagem }}" class='form-control' name="imagem" accept="image/*" />
                                    <span style='font-weight:bold;color:black'>Tamanho maximo: 10MB</span>
                                </div>
                                <div class="col-md-6">
                                    <a href="{!! asset($registro->imagem) !!}"><img src="{!! asset($registro->imagem) !!}" width=100 id="imgBanco"/></a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="Imagem">Imagem</label>
                            <input type='file' id="imagem" value="{{ $registro->imagem }}" class='form-control' name="imagem" accept="image/*" />
                            <span style='font-weight:bold;color:black'>Tamanho maximo: 10MB</span>
                        </div>
                        @endif

                        <button class="btn btn-info">Adicionar</button>
                        
                    </form>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                    <form action="{{route('carros.salvar')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="Marca">Cliente</label>
                            <input type="text" name="marca" class="form-control" placeholder="Cliente">                                
                        </div>
                        <div class="form-group">
                            <label for="Modelo">NF</label>
                            <input type="text" name="modelo" class="form-control" placeholder="Nf do produto">                               
                        </div>
                        <div class="form-group">    
                            <label for="Ano">Motivo</label>
                            <input type="text" name="ano" class="form-control" placeholder="Motivo da Peritagem">                                
                        </div>
                        <div class="form-group">
                            <label for="Imagem">Imagem</label>
                            <input type='file' id="imagem" class='form-control' name="imagem[]" accept="image/*" multiple />
                            <span style='font-weight:bold;color:black'>Tamanho maximo: 10MB</span>
                        </div>

                        <button class="btn btn-info">Adicionar</button>
                        
                    </form>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
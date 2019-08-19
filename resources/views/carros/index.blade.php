@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2 class='title'>Equipamento</h2>
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('carros.adicionar')}}" class='btn btn-success' style="float:right">Adicionar</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body table-responsive "> 

                        <table class="table" style='margin-top:30px;'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">NF</th>
                                    <th scope="col">Motivo</th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>           
                            @foreach($carros as $carro)                     
                                <tr>   
                                    <td>{{$carro->id}}</td>
                                    <td>{{$carro->marca}}</td>
                                    <td>{{$carro->modelo}}</td>
                                    <td>{{$carro->ano}}</td>
                                    @if(!empty($carro->imagem)) 
                                    <td>
                                    <a href="{!! asset("$carro->imagem") !!}"><img id="imgBanco" src="{!! asset("$carro->imagem") !!}" width=60 height=60 style=display:inherit /></a>
                                        <img id="" src="{!! asset('imagem\foto.jpg') !!}" width=52  style=display:none />
                                    </td> 
                                    @else
                                    <td>
                                        <img id="" src="{!! asset("$carro->imagem") !!}" width=100 style=display:none />
                                        <img id="" src="{!! asset('imagem\foto.jpg') !!}" width=52 style='display:inherit;filter:grayscale(100%)'/>
                                    </td> 
                                    @endif
                                    <td colspan=2>
                                        <a href="{{ route('carros.editar', $carro->id)  }}" class='btn btn-primary'>Editar</a>
                                        <a href="{{ route('carros.deletar', $carro->id)  }}" class='btn btn-danger'>Deletar</a>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    <div align="center">
                        {!! $carros->links() !!}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {

    $( ".title" ).click(function() {
        alert('cheguei');
        console.log("oi");
    });
    
});


</script>

@endsection

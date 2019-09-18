@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-md-offset-1">
                <div class="panel-heading text-center">
                    <form action="{{ route('carros.pesquisar') }}" method="get">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class='title'>Equipamento</h2>
                            </div>
                            <div class="col-md-12 m-t-20">
                                <input type="text" class=" w-40 h-30" name='id' placeholder="Digite o id para pesquisar">
                                <input type="text" class=" w-40 h-30" name='nf' placeholder="Digite a NF para pesquisar">
                                <button type="submit" class="btn btn-dark b-r-25">asdsad</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-body table-responsive "> 
                        <table class="table table-hover" style='margin-top:10px;'>
                            <thead style="border-top: 1px solid #dddddd;">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">NF</th>
                                    <th scope="col">Motivo</th>
                                    <!--<th scope="col">Imagem</th>-->
                                    <th scope="col">Ação</th>
                                    <th><a href="{{route('carros.adicionar')}}" class='btn btn-success b-r-25' style="float:right">Adicionar</a></th>
                                </tr>
                            </thead>
                            <tbody>           
                            @foreach($carros as $carro)                     
                                <tr>   
                                    <td>{{$carro->id}}</td>
                                    <td>{{$carro->marca}}</td>
                                    <td>{{$carro->modelo}}</td>
                                    <td>{{$carro->ano}}</td>
                                    <!--@if(!empty($carro->imagem)) 
                                    <td>
                                    <a href="{!! asset("$carro->imagem") !!}"><img id="imgBanco" src="{!! asset("$carro->img_miniatura") !!}" style=display:inherit /></a>
                                        <img id="" src="{!! asset('imagem\foto.jpg') !!}" width=52  style=display:none />
                                    </td> 
                                    @else
                                    <td>
                                        <img id="" src="{!! asset("$carro->imagem") !!}" width=100 style=display:none />
                                        <img id="" src="{!! asset('imagem\foto.jpg') !!}" width=52 style='display:inherit;filter:grayscale(100%)'/>
                                    </td> 
                                    @endif-->
                                    <td colspan=2>
                                        <a href="#" class='btn btn-success b-r-25'>Visualizar</a>
                                        <a href="{{ route('carros.editar', $carro->id)  }}" class='btn btn-primary b-r-25'>Editar</a>
                                        <a href="{{ route('carros.deletar', $carro->id)  }}" class='btn btn-danger b-r-25'>Deletar</a>
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


<script>

</script>
@endsection

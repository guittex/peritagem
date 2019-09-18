@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!---------Cabeçalho ------------------------------------>
        <div class="col-lg-12 col-md-12" style="padding:0px">
            <div class="panel-heading text-center">
                <div class="col-md-12 text-center m-b-30">
                    <h2 class='title m-b-40'>Par Cilindrico (Reto / Helicoidal ) - Pinhão</h2> 
                    <div class="col-lg-12" style="text-align:left">
                        <img class="float-r" src="{{ asset('img/plus.png') }}"  data-toggle="collapse" href="#adicionarPinhão" role="button" style="width:32px">
                        <a class="btn btn-primary"  data-toggle="collapse" href="#multiCollapseExample1" role="button">Menu</a>
                        <div class="collapse " id="multiCollapseExample1">
                            <div class="col-lg-4 col-md-4 col-sm-4">                          
                                <div class="list-group">
                                    <a href="{{ route('index.ParCilindricoEngrenagem', $peritagem->ID_Peritagem) }}" class="list-group-item list-group-item-action">Par Cilindrico Engrenagem</a>
                                    <a href="{{ route('index.EngrenagemInterna', $peritagem->ID_Peritagem) }}" class="list-group-item list-group-item-action">Engrenagem Interna Planetário</a>
                                    <a href="{{ route('itens.index', $peritagem->ID_Peritagem)}}" class="list-group-item list-group-item-action"><i class="fa fa-arrow-left"></i> Voltar</a>

                                </div>                                  
                            </div>

                        </div>
                    </div>
                </div>                    
            </div>            
            <!------ Fim Cabeçalho -------------------------------->

            <!----- Painel adicionar par cilindrico pinhao -------->
            <div id="adicionarPinhão" class="col-lg-12 col-md-12  m-t-10 collapse">
                <div class="panel panel-default">  
                    <form action="{{ route('adicionar.itens', $peritagem->ID_Peritagem) }}" method='POST'>
                        {{ csrf_field() }}
                        <div class="panel-heading text-center" style="background-color: #465686;color: white;">
                            <label>Par Cilindrico (Reto / Helicoidal) - (Pinhão)</label>
                        </div>
                        <div class="panel-body"> 
                            <input type="hidden" value='1' name='ID_TipoItem'>
                            <input type="hidden" value='index.ParCilindricoPinhao' name='rota'>
                            <div class="col-lg-12">
                                <label for="">Descrição:</label>
                                <input type="text" name="label">
                            </div>
                            <div class="col-lg-12 m-t-15">
                                <label for="">Condição:</label>
                                <div class="row text-center">
                                    <div class="col-lg-3 col-md-3">
                                        <input type="radio" id="trocar" value='1' name="condicao" style="width:28px;height:20px!important">
                                        <label for="trocar">Critico - Trocar</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <input type="radio" id="alerta" value='2' name="condicao" style="width:28px;height:20px!important">
                                        <label for="alerta">Alerta - Retrabalho</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <input type="radio" id="reutilizar" value='3' name="condicao" style="width:28px;height:20px!important">
                                        <label for="reutilizar">Ok - Reutilizar</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <input type="radio" id="NaoVeio" value='4' name="condicao" style="width:28px;height:20px!important">
                                        <label for="NaoVeio">Não Veio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 m-t-15">
                                <label for="">Medidas:</label>
                                <input type="text" name="medidas">
                            </div>
                            <div class="col-lg-6 col-md-6  m-t-15">
                                <label for="">Material:</label>
                                <input type="text" name="material">
                            </div>
                            <div class="col-lg-4 col-md-4  m-t-15">
                                <label for="">Dureza:</label>
                                <input type="text" class="placeholder-right" name="dureza" placeholder="HR c/HB">
                            </div>
                            <div class="col-lg-4 col-md-4  m-t-15">
                                <label for="">Trat. Térmico:</label>
                                <input type="text" name="trat_termico">
                            </div>
                            <div class="col-lg-4 col-md-4 m-t-15">
                                <label for="">Peso:</label>
                                <input type="text" class="placeholder-right" name="peso" placeholder="Kg">
                            </div>
                            <div class="col-lg-3 col-md-3 m-t-15">
                                <label for="">Nº Dentes:</label>
                                <input type="text" class="placeholder-left" name="n_dentes" placeholder="Z=">
                            </div>
                            <div class="col-lg-3 col-md-3 m-t-15">
                                <label for="">Ang. De Hélice:</label>
                                <input type="text" class="placeholder-right" name="ang_helice" placeholder="β">
                            </div>
                            <div class="col-lg-3 col-md-3 m-t-15">
                                <label for="">Setindo:</label>
                                <input type="text" name="sentido">
                            </div>
                            <div class="col-lg-3 col-md-3 m-t-15">
                                <label for="">Ang. De Pressão:</label>
                                <input type="text" class="placeholder-right" name="ang_pressao" placeholder="CX">
                            </div>
                            <div class="col-lg-4 col-md-4 m-t-15">
                                <label for="">W:</label>
                                <input type="text" class="placeholder-right" name="w" placeholder="HR c/HB">
                            </div>
                            <div class="col-lg-4 col-md-4 m-t-15">
                                <label for="">W + 1:</label>
                                <input type="text" name="w2">
                            </div>
                            <div class="col-lg-4 col-md-4 m-t-15">
                                <label for="">Módulo:</label>
                                <input type="text" class="placeholder-right" name="modulo" placeholder="Kg">
                            </div>
                            <div class="col-lg-12 m-t-15">
                                <label for="">Especial:</label>
                                <input type="text" >
                            </div>
                            <div class="col-lg-12 m-t-15">
                                <label for="">Descrição do Retrabalho / Falha:</label>
                                <textarea class="form-control" name="descricao" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    
                        <div class="panel-body text-center">
                            <button type="submit" class='btn btn-success'>Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!------------- Fim ---->

            <!---- Tabela com os itens do par cilindrico pinhao -->
            <div class="col-lg-12 col-md-12 table-responsive">
                <table class="table " >
                    <thead style="background-color:#333;color:white">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Condição</th>
                        <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registro as $array)
                        <tr>
                            <td>{{$array->ID_Item}}</td>
                            <td>{{$array->Descricao}}</td>
                            <td>{{$array->Detalhes}}</td>
                            <td id='condicao'>{{$array->Condicao}}</td>
                            <td><img src="{{ asset('img/search.png') }}" width="30" data-toggle="modal" data-target="#verPeritagem{{$array->ID_Item}}"></td>
                        </tr>       
                        <!-- Modal -->
                        <div class="modal fade" id="verPeritagem{{$array->ID_Item}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-center bold" id="exampleModalLabel">{{$array->Descricao}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <label for="">Descrição:</label>
                                                <input type="text" value="{{ $array->Descricao }}" name="label">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Condição:</label>
                                                <div class="row text-center">
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="radio" id="trocar" value='1' name="condicao" style="width:28px;height:20px!important">
                                                        <label for="trocar">Critico - Trocar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="radio" id="alerta" value='2' name="condicao" style="width:28px;height:20px!important">
                                                        <label for="alerta">Alerta - Retrabalho</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="radio" id="reutilizar" value='3' name="condicao" style="width:28px;height:20px!important">
                                                        <label for="reutilizar">Ok - Reutilizar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="radio" id="NaoVeio" value='4' name="condicao" style="width:28px;height:20px!important">
                                                        <label for="NaoVeio">Não Veio</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 m-t-15">
                                                <label for="">Medidas:</label>
                                                <input type="text" value="{{ $array->Medidas }}" name="medidas">
                                            </div>
                                            <div class="col-lg-6 col-md-6  m-t-15">
                                                <label for="">Material:</label>
                                                <input type="text" value="{{ $array->Material }}" name="material">
                                            </div>
                                            <div class="col-lg-4 col-md-4  m-t-15">
                                                <label for="">Dureza:</label>
                                                <input type="text" class="placeholder-right" value="{{ $array->Dureza }}" name="dureza" placeholder="HR c/HB">
                                            </div>
                                            <div class="col-lg-4 col-md-4  m-t-15">
                                                <label for="">Trat. Térmico:</label>
                                                <input type="text" value="{{ $array->Trat_Termico }}" name="trat_termico">
                                            </div>
                                            <div class="col-lg-4 col-md-4 m-t-15">
                                                <label for="">Peso:</label>
                                                <input type="text" value="{{ $array->Peso }}" class="placeholder-right" name="peso" placeholder="Kg">
                                            </div>
                                            <div class="col-lg-3 col-md-3 m-t-15">
                                                <label for="">Nº Dentes:</label>
                                                <input type="text" class="placeholder-left" value='{{ $array->Z }}' name="n_dentes" placeholder="Z=">
                                            </div>
                                            <div class="col-lg-3 col-md-3 m-t-15">
                                                <label for="">Ang. De Hélice:</label>
                                                <input type="text" class="placeholder-right" value="{{ $array->Ang_Helice }}" name="ang_helice" placeholder="β">
                                            </div>
                                            <div class="col-lg-3 col-md-3 m-t-15">
                                                <label for="">Setindo:</label>
                                                <input type="text" value="{{ $array->Sentido }}" name="sentido">
                                            </div>
                                            <div class="col-lg-3 col-md-3 m-t-15">
                                                <label for="">Ang. De Pressão:</label>
                                                <input type="text" value="{{ $array->Ang_Pressao }}" class="placeholder-right" name="ang_pressao" placeholder="CX">
                                            </div>
                                            <div class="col-lg-4 col-md-4 m-t-15">
                                                <label for="">W:</label>
                                                <input type="text" class="placeholder-right" value="{{ $array->W }}" name="w" placeholder="HR c/HB">
                                            </div>
                                            <div class="col-lg-4 col-md-4 m-t-15">
                                                <label for="">W + 1:</label>
                                                <input type="text" value="{{ $array->W2 }}" name="w2">
                                            </div>
                                            <div class="col-lg-4 col-md-4 m-t-15">
                                                <label for="">Módulo:</label>
                                                <input type="text" class="placeholder-right" value="{{ $array->Modulo }}" name="modulo" placeholder="Kg">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Especial:</label>
                                                <input type="text" value='Falta esse nego'>
                                            </div>
                                            <div class="col-lg-12 m-t-15 m-b-15">
                                                <label for="">Descrição do Retrabalho / Falha:</label>
                                                <textarea class="form-control" name="descricao" cols="30" rows="10">{{ $array->Detalhes }}</textarea>
                                            </div>                                            
                                        </div>
                                        <div class="modal-footer m-t-15">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn btn-success">Salvar mudanças</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!---- Fim tabela ------------------->                 
                    </tbody>
                </table>         
            </div>               
        </div>
    </div>
</div>
<script>
$('td[id="condicao"]').each(function() {
    var condicao = $(this).html();
    console.log(condicao);
    if(condicao == 1){
        $(this).html('Crítico - Trocar');
        $(this).css('color', 'red');    
    }
    if(condicao == 2){
        $(this).html('Alerta - Retrabalho');
        $(this).css('color', 'red');    
    }
    if(condicao == 3){
        $(this).html('Ok - Reutilizar');
        $(this).css('color', 'green');
    }
    if(condicao == 4){
        $(this).html('Não Veio');
    }
});
</script>
@endsection
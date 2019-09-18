@extends('layouts.app')

@section('content')
<?php
if(!empty($_GET['idPeritagem'])){

    $idPeritagem = $_GET['idPeritagem'];
}else{
    $link = $_SERVER['REQUEST_URI'];

    $ex = explode('/', $link);
    
    $idPeritagem = $ex[count($ex)-1];

}


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12" style="padding:0px">
                <div class="panel-heading text-center">
                    <div class="row">
                        <div class="col-md-12 text-center m-b-30">
                            <h2 class='title'>{{ $peritagem->Descricao}}</h2>
                        </div>
                        <form action="{{ route('itens.pesquisar')}}" method="GET">
                            <input type="hidden" name="idPeritagem" value={{$idPeritagem}}>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <input type="text" class="h-30" id="inputID" name='id' placeholder="Digite o ID para pesquisar">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <input type="text" class="h-30" id='inputDescricao' name='descricao' placeholder="Digite o algo da descrição para pesquisar">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-1"> 
                                <button type="submit" style="border:none;background-color:#f5f8fa"><img src="{{ asset('img/search.png') }}" class='m-r-30 iconPesquisa' style="width:24px"></button>             
                        </form>
                                <img src="{{ asset('img/plus.png') }}" type="" class="iconPesquisa" style="width:24px;">
                            </div>
                    </div>
                </div>
                <hr>
                <!----------Paineis inicio ------------->
                <div class="panel with-nav-tabs panel-default" style="border:none;background-color:#f5f8fa!important" >
                    <div class="panel-heading" style="background-color: gainsboro">
                        <ul class="nav nav-tabs"> 
                            <li class="active"><a href="#tab1default" data-toggle="tab" class="text-black">Dados do equipamento</a></li>
                            <li style=""><a href="#tab2default" data-toggle="tab" class="text-black">Acionamento</a></li>
                            <li><a href="#tab3default" data-toggle="tab" class="text-black">Carcaça</a></li>                    
                            <li><a href="#tab6default" data-toggle="tab" class="text-black">Arquivos</a></li>       
                            
                            <li class="dropdown">                                
                                <a href="#" data-toggle="dropdown" class="text-black">Itens<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('index.ParCilindricoPinhao', $idPeritagem) }}" class="text-black">Par Cilindrico(Pinhão)</a></li>
                                    <li><a href="{{ route('index.ParCilindricoEngrenagem', $idPeritagem) }}"href="#tab5default"  class="text-black">Par Cilindrico(Engrenhagem)</a></li>  
                                    <li><a href="{{ route('index.EngrenagemInterna', $idPeritagem) }}"  class="text-black">Engrenagem Interna(Planetário)</a></li>
                                    <li><a href="{{ route('index.ParConicoPinhao', $idPeritagem)}}" class="text-black">Par Cônico(Pinhão)</a></li>
                                    <li><a href="#tab9default" class="text-black">Par Cônico(Coroa)</a></li>                                          
                                </ul>
                            </li>   
                        </ul>  
                    </div>
                    <div class="panel-body">    
                        <div class="tab-content">
                
                            <!---------Painel 1 Dados de entrada ------->
                            <div class="tab-pane fade in active" id="tab1default">
                                <div class="panel panel-default">
                                    <form action="#">
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Dados de entrada</label></div>
                                        <div class="panel-body">                           
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label for="">Cliente:</label>
                                                <input type="text" name="" value="{{ $peritagem->ID_Cliente }}">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label for="">Nota Fiscal:</label>
                                                <input type="text" name="" value="{{ $peritagem->Nota_Fiscal }}">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Contrato:</label>
                                                <input type="text" name="" value="{{ $peritagem->N_Contrato }}">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">OS:</label>
                                                <input type="text" name="">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Produto:</label>
                                                <input type="text" name="">
                                            </div>   
                                        </div>  
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Dados do Equipamento</label></div>    
                                        <div class="panel-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                                <input type="radio" id="DadosPlaca" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="Dados de Placa">Dados de Placa</label>

                                                <input type="radio" id="Catalogo" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="Catálogo">Catálogo</label>

                                                <input type="radio" id="InformaçãoCliente" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="Informação do Cliente">Informação do Cliente</label>

                                                <input type="radio" id="Semidentificação" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="Sem identificação">Sem identificação</label>
                                            </div>        
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Fabricante:</label>
                                                <input type="text">
                                            </div>   
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Modelo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Rotação - IN:</label>
                                                <input id='reducao' class="placeholder-right" type="text" placeholder="rpm">
                                            </div> 
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Rotação - Out:</label>
                                                <input type="text" class="placeholder-right" placeholder="rpm">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Redução:</label>
                                                <input type="text" class="placeholder-left" placeholder="1:">
                                            </div> 
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Potência:</label>
                                                <input type="text" class="placeholder-left" placeholder="kW">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Fator de Serviço:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Ano de fabricação:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Lubrificação:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Viscosidade:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-10">
                                                <label for="">Volume:</label>
                                                <input type="text" class="placeholder-right" placeholder="Litros">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                                <label for="">Sentido de giro:</label>
                                                <div class="col-lg-12 text-center">
                                                    <input type="radio" id="Anti-Horário" name="example" value="" style="width:28px;height:20px!important">
                                                    <label for="Anti-Horário">Anti-Horário</label>

                                                    <input type="radio" id="Hórario" name="example" value="" style="width:28px;height:20px!important">
                                                    <label for="Hórario">Hórario</label>

                                                    <input type="radio" id="Bidirecional" name="example" value="" style="width:28px;height:20px!important">
                                                    <label for="Bidirecional">Bidirecional</label>
                                                    <hr>
                                                </div>
                                                <img src="{{ asset('img/sentido.png') }}" style="width:100%;">
                                                <hr>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <input type="radio" id="VistoEntrada" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="VistoEntrada">Visto da Entrada</label>

                                                <input type="radio" id="VistoSaida" name="example" value="" style="width:28px;height:20px!important">
                                                <label for="VistoSaida">Visto da Saída</label>
                                            </div>
                                        </div>  
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Dados Complementares</label></div>
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <label for="">Aplicação:</label>
                                                <input type="text" value="{{$peritagem->Aplicacao}}">
                                            </div>
                                            <div class="col-lg-12 m-t-10">
                                                <label for="">Motivo da Manutenção:</label>
                                                <input type="text" value="{{$peritagem->Motivo_Manutencao}}">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Peso:</label>
                                                <input type="text" class="placeholder-right" placeholder="kg">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Cor:</label>
                                                <input type="text" value="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Pintura:</label>
                                                <input type="text" placeholder="Padão Santana">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-10">
                                                <label for="">Outro:</label>
                                                <input type="text" value="">
                                            </div>
                                        </div> 
                                        <div class="panel-body text-center">
                                            <button type="submit" class='btn btn-success'>Salvar</button>
                                        </div>
                                    </form>                                                        
                                </div>                                              
                            </div>
                            <!-------- Fim do painel 1 ----------------->

                            <!-------- Painel 2 Acionamento ------------>
                            <div class="tab-pane fade" id="tab2default">
                                <div class="panel panel-default">
                                    <form action="#">
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Acionamento</label></div>
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <label for="">Tipo:</label>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <input type="radio" id="eletrico" name="example" style="width:28px;height:20px!important">
                                                <label for="eletrico">Motor Elétrico</label>

                                                <input type="radio" id="hidraulico" name="example" style="width:28px;height:20px!important">
                                                <label for="hidraulico">Motor Hidráulico</label>

                                                <input type="radio" id="SemMotor" name="example" style="width:28px;height:20px!important">
                                                <label for="SemMotor">Sem motor</label>

                                                <label for="outros" class="m-l-15">Outro:</label>
                                                <input type="text" id="outros" name="example" style="width:30%;height 20px!important">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Fabricante:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Modelo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Rotação(Polos):</label>
                                                <input type="text" class="placeholder-right" placeholder="rpm">
                                            </div>   
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Potência:</label>
                                                <input type="text" class="placeholder-right" placeholder="kw">
                                            </div>   
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Carcaça:</label>
                                                <input type="text">
                                            </div>       
                                            <div class="col-lg-12 m-t-15">
                                                <label>Ação:</label>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                        <input type="radio" id="SolicitarCliente" name="example" style="width:28px;height:20px!important">
                                                        <label for="SolicitarCliente">Solicitar ao cliente</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                        <input type="radio" id="FabricarDispositivos" name="example" style="width:28px;height:20px!important">
                                                        <label for="FabricarDispositivos">Fabricar Dispositivos</label>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                                                        <input type="radio" id="Manutencao" name="example" style="width:28px;height:20px!important">
                                                        <label for="Manutencao">Manutenção</label>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                                                        <input type="radio" id="Substituicao" name="example" style="width:28px;height:20px!important">
                                                        <label for="Substituicao">Substuição</label>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                                                        <input type="radio" id="Reutilizar" name="example" style="width:28px;height:20px!important">
                                                        <label for="Reutilizar">Reutilizar</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Descrição</label>
                                                <textarea class="form-control" cols="10" rows="5"></textarea>
                                            </div>  
                                        </div> 
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Teste do Redutor</label></div>
                                        <div class="panel-body"> 
                                            <div class="row text-center">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                                                    <input type="radio" id="Manutencao" name="example" style="width:28px;height:20px!important">
                                                    <label for="Manutencao">Não</label>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                    <input type="radio" id="Substituicao" name="example" style="width:28px;height:20px!important">
                                                    <label for="Substituicao">Sim </label>
                                                    <label class="float-r">=></label>
                                                </div>                                            
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                    <input type="radio" id="Reutilizar" name="example" style="width:28px;height:20px!important">
                                                    <label for="Reutilizar">Bancada de Teste</label>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                    <input type="radio" id="Reutilizar" name="example" style="width:28px;height:20px!important">
                                                    <label for="Reutilizar">Manualmente</label>
                                                </div>
                                            </div>                                      
                                        </div>    
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Inspeção Visual</label></div>
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <textarea class="form-control" cols="10" rows="5"></textarea>
                                            </div>                                            
                                        </div>   
                                        <div class="panel-body text-center">
                                            <button type="submit" class='btn btn-success'>Salvar</button>
                                        </div>                            
                                    </form>                           
                                </div>
                            </div>
                            <!------- Fim do Painel 2 ------------------>

                            <!-------- Painel 3 Caracaça---------------->
                            <div class="tab-pane fade" id="tab3default">
                                <div class="panel panel-default">  
                                    <form action="#">
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Carcaça</label></div>
                                        <div class="panel-body">
                                            <div class="col-lg-12 text-center">
                                                <label for="">Medição dos furos com subito para avaliar erro geometrico e desvio dimensional</label>
                                            </div>
                                            <div class="col-lg-6 m-t-15">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Pós:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>   
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Medição:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>    
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Tolerância:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="col-lg-6 m-t-15">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Pós:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>   
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Medição:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>    
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Tolerância:</label>
                                                    <textarea class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Inspetor:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Data:</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Medição de Alinhamento - Braço tridimensional</label></div>
                                        <div class="panel-body">
                                                <div class="col-lg-6 col-md-6 col-sm-6" style="text-align:right">
                                                    <input type="radio" id="Não" name="example" style="width:28px;height:20px!important">
                                                    <label for="Não">Não</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="radio" id="Sim" name="example" style="width:28px;height:20px!important">
                                                    <label for="Sim">Sim </label>
                                                    <label for=""> => Caso sim, anexar resultados de medição na aba de Arquivos</label>
                                                </div>     
                                                <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                    <label for="">Inspetor:</label>
                                                    <input type="text">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                    <label for="">Data:</label>
                                                    <input type="text">
                                                </div>
                                        </div>
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Retrabalho</label></div>
                                        <div class="panel-body">
                                            <div class="col-lg-2 col-md-6 col-sm-6">
                                                <input type="radio" id="Fabricar" name="example" style="width:28px;height:20px!important">
                                                <label for="Fabricar">Fabricar</label>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-6">
                                                <input type="radio" id="Reutilizar" name="example" style="width:28px;height:20px!important">
                                                <label for="Reutilizar">Reutilizar </label>
                                            </div> 
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <input type="radio" id="Embuchamento" name="example" style="width:28px;height:20px!important">
                                                <label for="Embuchamento">Embuchamento</label>
                                            </div>    
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <input type="radio" id="RepassarFaces" name="example" style="width:28px;height:20px!important">
                                                <label for="RepassarFaces">Repassar Faces</label>
                                            </div>    
                                            <div class="col-lg-2 col-md-6 col-sm-6">
                                                <input type="radio" id="Outros" name="example" style="width:28px;height:20px!important">
                                                <label for="Outros">Outros</label>
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Medidas externas</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="panel-body text-center">
                                            <button type="submit" class='btn btn-success'>Salvar</button>
                                        </div> 
                                    </form>
                                </div>                       
                            </div>
                            <!------- Fim do Painel 3 ------------------>

                            <!------- Painel 4 ------>                             
                            <!------------ Par conico Pinhao ----------->
                            <div class="tab-pane fade" id="tab8default">
                                <div class="panel panel-default">  
                                    <form action="#">
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;">
                                            <label>Par cônico (Reto / Helicoidal) - (Pinhão)</label>
                                        </div>
                                        <div class="panel-body"> 
                                            <div class="col-lg-12">
                                                <label for="">Descrição:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Condição:</label>
                                                <div class="row text-center">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="trocar" name="example" style="width:28px;height:20px!important">
                                                        <label for="trocar">Critico - Trocar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="alerta" name="example" style="width:28px;height:20px!important">
                                                        <label for="alerta">Alerta - Retrabalho</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="reutilizar" name="example" style="width:28px;height:20px!important">
                                                        <label for="reutilizar">Ok - Reutilizar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="NaoVeio" name="example" style="width:28px;height:20px!important">
                                                        <label for="NaoVeio">Não Veio</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Medidas:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Material:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Dureza:</label>
                                                <input type="text" class="placeholder-right" placeholder="HR c/HB">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Trat. Térmico:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Peso:</label>
                                                <input type="text" class="placeholder-right" placeholder="Kg">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Nº Dentes:</label>
                                                <input type="text" class="placeholder-left" placeholder="Z=">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Helicoildal:</label>
                                                <input type="text" class="placeholder-right" placeholder="Sim ou não">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Setindo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Ang. De Pressão:</label>
                                                <input type="text" class="placeholder-right" placeholder="CX">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Cone Externo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Cone Interno:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Método de Fabricação:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Especial:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Descrição do Retrabalho / Falha:</label>
                                                <textarea class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>                                        
                                        <div class="panel-body text-center">
                                            <button type="submit" class='btn btn-success'>Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!------------ Par conico Pinhao ----------->
                            <div class="tab-pane fade" id="tab9default">
                                <div class="panel panel-default">  
                                    <form action="#">
                                        <div class="panel-heading text-center" style="background-color: #465686;color: white;">
                                            <label>Par cônico (Reto / Helicoidal) - (Coroa)</label>
                                        </div>
                                        <div class="panel-body"> 
                                            <div class="col-lg-12">
                                                <label for="">Descrição:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Condição:</label>
                                                <div class="row text-center">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="trocar" name="example" style="width:28px;height:20px!important">
                                                        <label for="trocar">Critico - Trocar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="alerta" name="example" style="width:28px;height:20px!important">
                                                        <label for="alerta">Alerta - Retrabalho</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="reutilizar" name="example" style="width:28px;height:20px!important">
                                                        <label for="reutilizar">Ok - Reutilizar</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="radio" id="NaoVeio" name="example" style="width:28px;height:20px!important">
                                                        <label for="NaoVeio">Não Veio</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Medidas:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 m-t-15">
                                                <label for="">Material:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Dureza:</label>
                                                <input type="text" class="placeholder-right" placeholder="HR c/HB">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Trat. Térmico:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Peso:</label>
                                                <input type="text" class="placeholder-right" placeholder="Kg">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Nº Dentes:</label>
                                                <input type="text" class="placeholder-left" placeholder="Z=">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Helicoildal:</label>
                                                <input type="text" class="placeholder-right" placeholder="Sim ou não">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Setindo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 m-t-15">
                                                <label for="">Ang. De Pressão:</label>
                                                <input type="text" class="placeholder-right" placeholder="CX">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Cone Externo:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Cone Interno:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 m-t-15">
                                                <label for="">Método de Fabricação:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Especial:</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-12 m-t-15">
                                                <label for="">Descrição do Retrabalho / Falha:</label>
                                                <textarea class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>                                        
                                        <div class="panel-body text-center">
                                            <button type="submit" class='btn btn-success'>Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!------- Fim do Painel 4 ------------------>
                            
                            <!--Painel 6 Arquivos-->
                            <div class="tab-pane fade" id="tab6default">
                                <div class="panel panel-default"> 
                                    <div class="panel-heading text-center" style="background-color: #465686;color: white;"><label>Arquivos</label></div>
                                    <div class="panel-body">
                                        <div class="col-lg-12 m-t-15">
                                            <form method="POST" action="{{ route('imagens.salvar') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <input type="hidden" name="idPeritagem" value="{{ $peritagem->ID_Peritagem }}">

                                                    <input type="hidden" name="idItem" value="">

                                                    <label for="">Resumo</label>
                                                    <input type='text' class="m-b-15" id="label" name='label' placeholder="Descreva em poucas palavras sobre a imagem">

                                                    <label for="">Descrição Completa</label>
                                                    <input type='text' class="m-b-15" id="descricao" name='descricao' placeholder="Descreva uma breve descrição sobre a imagem">

                                                    <label for="">Escolha uma Imagem</label>
                                                    <input type=file id="addFotoGaleria" name='ImageInput[]' accept="image/*" multiple >
                                                    <!--<img id="imageFile" name="Image" class='w-50 b-r-25 m-t-20 p-20' />
                                                    <div class=" text-center">
                                                        <button class="btn btn-primary m-t-10 b-r-25" type='button' id="BtnResetar" style="display:none">Resetar</button>
                                                    </div>-->

                                                    <div class="galeria text-center">
                 
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" id='ResetFotos' data-dismiss="modal">Resetar Fotos</button>
                                                    <button type="submit" class="btn btn-success">Adicionar</button>
                                                </div>
                                            </form>
                                        </div>  
                                    </div>                                
                                    <div class="panel-heading text-center" style="background-color: #465686;color: white;">
                                        <label>Imagens anexadas</label>
                                        <img src="{{ asset('img/image.png') }}" data-toggle="modal" data-target="#modalImg" alt="" style="width:30px;float:right">
                                    </div>
                                    <div class="panel-body">
                                        {{ getPath_Image($peritagem->ID_Peritagem) }}
                                    </div>
                                    <!--------Modal Imagem principal ----->
                                    <div class="modal fade" id="modalImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <label for="" style="font-size:20px">Escolha uma Imagem  </label>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('imagens.salvar') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idPeritagem" value="">

                                                        <input type="hidden" name="idItem" value="">
                                                        <div class="row">   
                                                            {{ setImagePrincipal($idPeritagem) }}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----Fim do painel 6---->
                        </div>
                    </div>
                </div>
                <!-----Paineis FIM----->

                <!--
                @foreach($registro as $array)
                <div class="panel-body table-responsive m-t-30 m-b-50 text-center" id="painelItem"> 
                    <div class="row">
                        @if(!empty($_GET['idPeritagem']))
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <a href="{{ route('itens.index', $_GET['idPeritagem']) }}"><button class='btn btn-primary b-r-25 float-r'>Listar todos</button></a>
                        </div>
                        @endif
                        <div class="col-12 text-center m-b-30  @if(!empty($_GET['idPeritagem'])) m-t-50 @endif">
                            <h3>Item {{ $array->ID_Item }}</h3>
                        </div>
                        <div class="col-12">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <label for="" class='bold'>Decricao:</label>
                            <input type="text" value="{{ $array->Descricao }}">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-4">
                            <label for="" class='bold'>Criado por:</label>
                            <input type="text" value="{{ $array->Usuario_Cria }}">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-4">
                            <label for="" class='bold'>Data da criação:</label>
                            <?php  $date = new datetime($array->DT_Cria); ?>
                            <input type="text" value="{{ $date->format('d-m-Y') }}">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                            <label for="" class='bold'>Detalhe:</label>
                            <textarea type="text" class="form-control">{{$array->Detalhes}}</textarea>
                        </div>        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                            <label for="" class='bold'>Conclusão:</label>
                            <textarea type="text" class="form-control">{{$array->Conclusao}}</textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-b-0 m-t-20">
                            <button class='btn btn-success '>Salvar</button>
                        </div>
                        <!------DIV DAS IMAGENS ----><!--
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-5">         
                            <hr>                   
                            <label for="" class='bold m-l-82'>Arquivos:</label>
                            <img src="{{ asset('img/image.png') }}" type="" data-toggle="modal" data-target="#ImgPrincipal{{ $array->ID_Item }}" class="iconPesquisa float-r m-l-25" style="width:29px;">
                            <img src="{{ asset('img/plus.png') }}" type="" data-toggle="modal" data-target="#{{ $array->ID_Item }}" class="iconPesquisa float-r" style="width:24px;">
                            <hr>
                            <div class="row">                           
                                {{ getPath_Image($array->ID_Item) }}
                            </div>
                            <!--------Modal adicionar imagens -----><!--
                            <div class="modal fade" id="{{ $array->ID_Item }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <label for="" style="font-size:20px">Item {{ $array->ID_Item }}</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('imagens.salvar') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <input type="hidden" name="idPeritagem" value="{{ $idPeritagem }}">

                                                <input type="hidden" name="idItem" value="{{ $array->ID_Item }}">

                                                <label for="">Resumo</label>
                                                <input type='text' class="m-b-15" id="label" name='label' placeholder="Descreva em poucas palavras sobre a imagem">

                                                <label for="">Descrição Completa</label>
                                                <input type='text' class="m-b-15" id="descricao" name='descricao' placeholder="Descreva uma breve descrição sobre a imagem">

                                                <label for="">Escolha uma Imagem</label>
                                                <input type=file id="addImage" name='ImageInput[]' accept="image/*" multiple >

                                                <img id="imageFile" name="Image" class='w-50 b-r-25 m-t-20 p-20' />
                                                <div class=" text-center">
                                                    <button class="btn btn-primary m-t-10 b-r-25" id="BtnResetar" style="display:none">Resetar</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-success">Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--------Modal Imagem principal -----><!--
                            <div class="modal fade" id="ImgPrincipal{{ $array->ID_Item }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <label for="" style="font-size:20px">Escolha uma Imagem  </label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('imagens.salvar') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <input type="hidden" name="idPeritagem" value="">

                                                <input type="hidden" name="idItem" value="">
                                                <div class="row">                           
                                                    {{ setImagePrincipal($array->ID_Item) }}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                                            
                    </div>                   

                    <div align="center">
                    </div> 
                </div>
                @endforeach-->

        </div>
    </div>
</div>   
@endsection

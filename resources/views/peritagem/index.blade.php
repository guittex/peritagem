@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-md-offset-1">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12 text-center m-b-30">
                        <h2 class='title'>Peritagem</h2>
                    </div>
                    <form action="{{ route('peritagem.pesquisar') }}" method="GET">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <input type="text" class="h-30" id="inputID" name='Nome' placeholder="Digite o Nome do cliente para pesquisar">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="h-30" id='inputDescricao' name='Nota_Fiscal' placeholder="Digite alguns Nº da nota para pesquisar">
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-12 m-t-15">
                            <input type="text" class="h-30" id='inputDescricao' name='descricao' placeholder="Digite o algo da descrição para pesquisar">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-12 m-t-15">
                            <button type="submit" id="btnPesquisa" class="btn btn-dark b-r-25">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12" >
                <hr style="border-color:#dddddd!important">
                <a href="{{ route('peritagem.pendente')}}"><button class='btn btn-danger' id='BtnPendentes'>Pendente</button></a>
                <a href="{{ route('peritagem.processo') }}"><button class='btn btn-warning' id='BtnProcesso'>Em processo</button></a>
                <a href="{{ route('peritagem.revisado') }}"><button class='btn btn-success' id='BtnRevisado'>Revisado</button></a>  
            </div>
            <div class="panel-body table-responsive "> 
                    <table class="table table-hover" style='margin-top:0px;'>
                        <thead style="border-top: 1px solid #dddddd;">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Croqui</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Nota Fiscal</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Detalhe</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Criado</th>
                                <th scope="col">Previsto</th>
                                <th scope="col">Ação</th>
                                <th colspan='2'><a href="{{ route('peritagem.adicionar') }}"><img src="{{ asset('img/plus.png') }}" style="width:32px"></a></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaPeritagem">           
                        @foreach($registro as $array)  
                            <?php 
                                $criadoFormat = getDateFormat($array->DT_CRIA);
                                $previstoFormat = getDateFormat($array->DT_Prevista);
                                $DT_PrazoFormat = getDateFormat($array->DT_Prazo);
                                $DT_EntradaFormat = getDateFormat($array->DT_Entrada);
                                $DT_RecebimentoFormat = getDateFormat($array->DT_Recebimento);                                    
                            ?>                   
                            <tr>   
                                <td>{{$array->ID_Peritagem}}</td>
                                <td><img id="imagemCroqui" src="{{ getCroqui($array->ID_Peritagem) }}" style="width:80px;border-radius:15px"/></td>
                                <td>{{$array->ID_Cliente}}</td>
                                <td>{{$array->Nota_Fiscal}}</td>
                                <td>{{$array->Descricao}}</td>
                                <td>{{$array->Detalhes}}</td>
                                <td style="color:{{getCorSituacao($array->ID_Situacao)}}">{{getSituacao($array->ID_Situacao)}}</td> 
                                <td>{{$criadoFormat}}</td> 
                                <td>{{$previstoFormat}}</td>                         
                                <td><a href="#"  data-toggle=modal data-target='#ModalEditar' data-whatever="<?php echo $array->ID_Peritagem  ?>" data-whatevercliente="<?php echo $array->ID_Cliente ?>" data-whatevernf="<?php echo $array->Nota_Fiscal ?>" data-whatevercontrato="<?php echo $array->N_Contrato ?>" data-whateverrecebimento="<?php echo $DT_RecebimentoFormat ?>" data-whateverentrada="<?php echo $DT_EntradaFormat?>" data-whateverprazo="<?php echo $DT_PrazoFormat ?>" data-whateverprotocolo="<?php echo $array->Protocolo ?>" data-whateversetor="<?php echo $array->Setor ?>" data-whateverdescricao="<?php echo $array->Descricao ?>" data-whateverreferencia="<?php echo $array->Referencia ?>" data-whateverdetalhe="<?php echo $array->Detalhes ?>" data-whateverescolha="<?php echo $array->ID_Tipo ?>" data-whatevermotivoman="<?php echo $array->Motivo_Manutencao ?>" data-whateveraplicacao="<?php echo $array->Aplicacao ?>"><img src="{{ asset('img/lamp.png') }}" style="margin:5px;width:32px"></a></td>
                                <td><a href="{{ route('itens.index', $array->ID_Peritagem) }}"><img src="{{ asset('img/search.png') }}" style="margin:5px;width:32px"></a></td>
                                <td><a href="{{ route('peritagem.deletar', $array->ID_Peritagem) }}" ><img src="{{ asset('img/delete.png') }}" style="margin:5px;width:32px"></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <div align="center">
                    {!! $registro->links() !!}
                </div> 
            </div>
        </div>
    </div>
</div>


<!--INICIO MODAL EDITAR-->
<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style='border-radius:15px;'>
            <div class="modal-header">
                <input type="text" class="" id='TituloEditar' style='border:none;font-size: 22px;font-weight:bold;text-align:center' readonly>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:34px">&times;</span></button>
            </div>
            <div class="modal-body" style="">
                <form method="POST" action="{{ route('peritagem.editar') }}">
                    {{ csrf_field() }}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Cliente</label>
                            <input name="cliente" type="text" id="recipient-cliente">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Nota Fiscal:</label>
                            <input name="Nota_Fiscal" type="text" id="recipient-nf">
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Nº Contrato:</label>
                            <input name="N_Contrato" type="text" id="recipient-contrato">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Recebimento</label>
                            <input name="DT_Recebimento" type="input" id="recipient-recebimento">
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Entrada</label>
                            <input name="DT_Entrada" type="input" id="recipient-entrada">
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Prazo</label>
                            <input name="DT_Prazo" type="input" id="recipient-prazo">
                        </div>               
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
                            <label for="">Protocolo</label>
                            <input name="Protocolo" type="text" id="recipient-protocolo">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
                            <label for="">Setor</label>
                            <input name="Setor" type="text" id="recipient-setor">
                        </div>  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Descrição</label>
                            <input name="descricao" type="text" id="recipient-descricao">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Referência:</label>
                            <textarea name="Referencia" class='form-control text-center' cols="3" rows="3" id="recipient-referencia"></textarea>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Observações:</label>
                            <textarea name="detalhes" class='form-control text-center' cols="3" rows="3" id="recipient-detalhe"></textarea>
                        </div>   
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 m-t-20 text-center">
                            <hr>  
                                <input type="radio" id="Peritagem" name="ID_Tipo" value="1" style="width:28px;height:20px!important">
                                <label for="Peritagem">Peritagem</label>  
                            <hr>                       
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 m-t-20 text-center">
                            <hr>  
                                <input type="radio" id="Devolucao" name="ID_Tipo" value="2" style="width:28px;height:20px!important">
                                <label for="Devolução">Devolução</label>
                            <hr>    
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 m-t-20 text-center">
                            <hr>  
                                <input type="radio" id="Desenho" name="ID_Tipo" value="3" style="width:28px;height:20px!important">
                                <label for="Desenho">Desenho</label>
                            <hr>  
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 m-t-20 text-center">
                            <hr>  
                                <input type="radio" id="Projeto" name="ID_Tipo" value="4" style="width:28px;height:20px!important">
                                <label for="Projeto">Projeto</label>
                            <hr>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="">Motivo da Manutenção:</label>
                            <textarea name="Motivo_Manutencao" class='form-control text-center' id="recipient-motivoman" cols="3" rows="3"></textarea>
                        </div>    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20 m-b-20">
                            <label for="">Aplicação</label>
                            <input name="Aplicacao" type="text" id="recipient-aplicacao">
                        </div>  

                    <input name="id" type="hidden" class="form-control" id="id" value="">
                                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Alterar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--FIM MODAL EDITAR-->
@endsection

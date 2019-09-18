@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-md-offset-1">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class='title'>Solicitação de Peritagem</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body table-responsive m-t-10 m-b-50 text-center">
                <form action="{{ route('peritagem.salvar') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <hr>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Cliente</label>
                            <input name="cliente" type="text" placeholder="Digite o nome do cliente" required>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Nota Fiscal:</label>
                            <input name="Nota_Fiscal" type="text" placeholder="Digite o número da nota" required>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Nº Contrato:</label>
                            <input name="N_Contrato" placeholder="Digite o número do contrato" type="text" required>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Recebimento</label>
                            <input name="DT_Recebimento" type="date" required>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Entrada</label>
                            <input name="DT_Entrada" type="date" required>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 m-t-20">
                            <label for="">Prazo</label>
                            <input name="DT_Prazo" type="date" required>
                        </div>               
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
                            <label for="">Protocolo</label>
                            <input name="Protocolo" type="text" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
                            <label for="">Setor</label>
                            <input name="Setor" type="text" required>
                        </div>  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Descrição</label>
                            <input name="descricao" type="text" required>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Referência:</label>
                            <textarea name="Referencia" class='form-control' id="" cols="3" rows="3" required></textarea>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Observações:</label>
                            <textarea name="detalhes" class='form-control' id="" cols="3" rows="3" required></textarea>
                        </div>     
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <hr>
                                <input type="radio" id="Peritagem" name="ID_Tipo" value="1" style="width:28px;height:20px!important">
                                <label for="Peritagem">Peritagem</label>

                                <input type="radio" id="Devolução" name="ID_Tipo" value="2" style="width:28px;height:20px!important">
                                <label for="Devolução">Devolução</label>

                                <input type="radio" id="Desenho" name="ID_Tipo" value="3" style="width:28px;height:20px!important">
                                <label for="Desenho">Desenho</label>

                                <input type="radio" id="Projeto" name="ID_Tipo" value="4" style="width:28px;height:20px!important">
                                <label for="Projeto">Projeto</label>
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="">Motivo da Manutenção:</label>
                            <textarea name="Motivo_Manutencao" class='form-control' id="" cols="3" rows="3" required></textarea>
                        </div>    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <label for="">Aplicação</label>
                            <input name="Aplicacao" type="text" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                            <a href="{{ route('peritagem.index') }}"><button class='btn btn-danger m-r-10' type="button" style="width:90px">Voltar</button></a>
                            <button class='btn btn-success' style="width:90px">Adicionar</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
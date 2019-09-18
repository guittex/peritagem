@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
        <!---------Cabeçalho ------------------------------------>
        <div class="col-lg-12 col-md-12" style="padding:0px">
            <div class="panel-heading text-center">
                <div class="col-md-12 text-center m-b-30">
                    <h2 class='title m-b-40'>Par Cônico (Reto / Helicoidal ) - Pinhão</h2> 
                    <div class="col-lg-12" style="text-align:left">
                        <img class="float-r" src="{{ asset('img/plus.png') }}"  data-toggle="collapse" href="#adicionarPinhão" role="button" style="width:32px">
                        <a class="btn btn-primary"  data-toggle="collapse" href="#multiCollapseExample1" role="button">Menu</a>
                        <div class="collapse " id="multiCollapseExample1">
                            <div class="col-lg-4 col-md-4 col-sm-4">                          
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">Par Cônico Coroa</a>
                                    <a href="{{ route('itens.index', $peritagem->ID_Peritagem)}}" class="list-group-item list-group-item-action"><i class="fa fa-arrow-left"></i> Voltar</a>
                                </div>                                  
                            </div>

                        </div>
                    </div>
                </div>                    
            </div>            
            <!------ Fim Cabeçalho -------------------------------->

            <!----- Painel adicionar par conico pinhao -------->
            <div id="adicionarPinhão" class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-10 collapse">
                <div class="panel panel-default">  
                    <form action="´#">
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

            <!------------- Fim ---->

            <!---- Tabela com os itens do par cilindrico pinhao -->
            <div class="col-lg-12 col-md-12">
                <table class="table">
                    <thead style="background-color:#333;color:white">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!---- Fim tabela ------------------->
        </div>
    </div>
</div>

@endsection
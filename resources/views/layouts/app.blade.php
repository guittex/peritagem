<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Peritagem</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Guilherme Felipe de Olveira">
    <link rel="icon" href="{{ asset('img/search.png') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts_krub.css') }}" rel="stylesheet">

    <!-- MDBootstrap Datatables --> 
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ ('css/bootstrap.min.css') }}" rel="stylesheet">-->



    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">


</head>
<style>
.miniatura {
    height: 100px;
    border: 1px solid #000;
    margin: 20px 5px 0 0;
  }

  #imagemCroqui:hover {
  -webkit-transform: scale(2,2);
  filter: contrast(100%)!important;
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header m-b-10" >

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/peritagem') }}">
                        <img src="{{ asset('img/logo-fresadora.jpg') }}" id="imgLogo" alt="">                        
                    </a>


                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="margin-top:8px; letter-spacing:2px">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::check())

                    <ul class="nav navbar-nav navbar-right">
                        &nbsp;
                        <!-- Se tiver logado -->

                        <li><a href="{{ url('/peritagem') }}">Home</a></li>

                    </ul>
                    @endif


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Entrar</a></li>
                            <li><a href="{{ route('teste') }}">Teste</a></li>

                            <!--<li><a href="{{ route('register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Bem Vindo Sr.(a) {{ Auth::user()->name }} <span class="caret"></span>

                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if(Session::has('flash_message'))
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div align='center' class="alert {{ Session::get('flash_message')['class'] }}">
                        {{ Session::get('flash_message')['msg'] }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </div>

    <div class="container-fluid" style="padding:0px!important">
        <footer class="rodape">
            <div class="social-icon" style="margin-bottom:15px;">
                <a href="{{ route('peritagem.index') }}"><img src="{{ asset('img/home.ico') }}" class="m-t-4" style="width:25px;color:white"></a>
                <a href="https://webmail.fresadorasantana.com.br/"><img src="{{ asset('img/mail.ico') }}" class="m-t-4" style="width:25px;color:white"></a>
                <a href="http://192.168.1.214:8086/ramais/listar_ramais_modal.php"><img src="{{ asset('img/logo2.ico') }}" style="width:30px;"></a>
            </div>
            <div class="footer" style="font-size: 15px">
                <a href="http://www.fresadorasantana.com.br/site/index.html">Home</a>
                <a href="http://www.fresadorasantana.com.br/site/empresa.html">Sobre Nós</a>
                <a href="http://www.fresadorasantana.com.br/site/produtos.html">Produtos</a>        
                <a href="http://www.fresadorasantana.com.br/site/contato.html">Contato</a>
            </div>         
            <p class="copyright" style="font-size: 15px;">Copyright Fresadora Santana 2018. Todos os direitos reservados.</p>    
        </footer>
    </div>

    <!-- Scripts -->   



    <script src="{{ asset('js/app.js') }}"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script>
        $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
            </script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/addons/datatables.min.js') }}"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

    <script>
        function readURL(input) 
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $(input).next()
                .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
            }
            else {
                var img = input.value;
                $(input).next().attr('src',img);
            }
        } 

        function verificaMostraBotao()
        {
            $('input[type=file]').each(function(index){
                if ($('input[type=file]').eq(index).val() != ""){
                    readURL(this);
                    $('.hide').show();
                }
            });
        }

        $('input[type=file]').on("change", function(){
        verificaMostraBotao();
        });

        $('.hide').on("click", function(){
            $(document.body).append($('<input />', {type: "file" }).change(verificaMostraBotao));
            $(document.body).append($('<img />'));
            $('.hide').hide();
        });

        
    </script>

    <script>

        $("#ResetFotos").click(function(){
            //$(this).css('display', 'none');
            $('#addFotoGaleria').val("");
            $(".galeria").fadeOut();
            $('.miniatura').remove()

        });

        $("#addFotoGaleria").click(function(){
            $(".galeria").fadeIn();
            $('.miniatura').remove()

        });

    </script>
    <!--SCRIPT EDITAR MODAL-->
    <script type="text/javascript">
    $('#ModalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var recipientcliente = button.data('whatevercliente')
        var recipientnf= button.data('whatevernf')
        var recipientcontrato = button.data('whatevercontrato')
        var recipientrecebimento = button.data('whateverrecebimento')
        var recipiententrada = button.data('whateverentrada')
        var recipientprazo = button.data('whateverprazo')
        var recipientprotocolo = button.data('whateverprotocolo')
        var recipientsetor = button.data('whateversetor')
        var recipientdescricao = button.data('whateverdescricao')        
        var recipientreferencia = button.data('whateverreferencia')
        var recipientdetalhe = button.data('whateverdetalhe')
        var recipientescolha = button.data('whateverescolha');
        var recipientmotivoman = button.data('whatevermotivoman');
        var recipientaplicacao = button.data('whateveraplicacao');
        

        if(recipientescolha == 1){
            document.getElementById("Peritagem").checked = true;
        }

        if(recipientescolha == 2){
            document.getElementById("Devolucao").checked = true;
        }

        if(recipientescolha == 3){
            document.getElementById("Desenho").checked = true;
        }

        if(recipientescolha == 4){
            document.getElementById("Projeto").checked = true;
        }

        $("#TituloEditar").val(recipientcliente);
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ID ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-cliente').val(recipientcliente)
        modal.find('#recipient-nf').val(recipientnf)
        modal.find('#recipient-contrato').val(recipientcontrato)
        modal.find('#recipient-recebimento').val(recipientrecebimento)
        modal.find('#recipient-entrada').val(recipiententrada)
        modal.find('#recipient-prazo').val(recipientprazo)        
        modal.find('#recipient-protocolo').val(recipientprotocolo)
        modal.find('#recipient-setor').val(recipientsetor)
        modal.find('#recipient-descricao').val(recipientdescricao)
        modal.find('#recipient-referencia').val(recipientreferencia)
        modal.find('#recipient-detalhe').val(recipientdetalhe)
        modal.find('#recipient-motivoman').val(recipientmotivoman)
        modal.find('#recipient-aplicacao').val(recipientaplicacao)

    })
</script>

<script>


$(function() {
// Pré-visualização de várias imagens no navegador
var visualizacaoImagens = function(input, lugarParaInserirVisualizacaoDeImagem) {

    if (input.files) {
        var quantImagens = input.files.length;

        for (i = 0; i < quantImagens; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img class="miniatura" id="imagemCroqui">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);


            }

            reader.readAsDataURL(input.files[i]);
        }
    }

};

//Chama a função quando seleciona as fotos
$('#addFotoGaleria').on('change', function() {
    visualizacaoImagens(this, 'div.galeria');
});
});


</script>

<!--Ajax example
<script>
    $( "#BtnPendente" ).click(function() {

        console.log('cheguei');
        var pendente = 'Pendente';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        
        $.ajax({
            type: 'POST',
            url:"{{ url('/peritagem/pesquisar/ajax') }}",
            data: {
                'Situacao': 'Pendente'
            },
            success:function(data){
                console.log(data);
                $("#tabelaPeritagem").html(data);

            },error:function(){ 
                alert("error!!!!");
            }
            
        });    
    });         
</script>
-->
</body>
</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

class ControllerCarros extends Controller
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        $this->middleware("auth");
    
    }

    public function index()
    {
        //Pega dados da model e define limite de paginação
        $carros = \App\Carros::paginate(6);

        //Retorna para view e manda a variavel retornada da model         
        return view('carros.index',compact('carros'));
    }

    public function adicionar()
    {
        return view('carros.adicionar');
    }

        
    private function getTamanhoMaximo($tamanho_arquivo){
        //dd($tamanho_arquivo);

        //Verifica se o tamanho do arquivo é maior que 10 MB 
        if($tamanho_arquivo > 10000000)
        {
            \Session::flash('flash_message',[ 
                "msg" => "Tamanho do arquivo maior que 10MB",
                "class" => "alert-danger"
            ]);

            //dd("to dentro do if");
        }

        return $tamanho_arquivo;
    }

    private function getExtensaoValida($tipo_arquivo, $tipos_validos)
    {        
        //dd($tipo_arquivo);
        
        //Verifica se no array tem a extensão compativel
        if(in_array($tipo_arquivo, $tipos_validos)){                

            return true;
            
        }else{
            \Session::flash('flash_message',[
                "msg" => "Tipo do arquivo invalido, tipo do arquivo atual = $tipo_arquivo",
                "class" => "alert-danger"
            ]);

            return false;
        }

        return;
        
    }

        public function getAlteraImagem($input_image , $parameter){

        //Parametros chamados pela função de editar
        if($parameter == 2 or $parameter == '4'){
            $lastIdRequest = $input_image['id'];
            $input_image = $input_image['imagem'];            
        }

        //Parametros chamado pela função adicionar
        if($parameter == 1 or $parameter == '3'){
            //Pego o ultimo ID do model
            $lastId = \App\Carros::orderBy('id', 'desc')
                                        ->take(1)
                                        ->get();

            //Percorre os registro
            foreach ($lastId as $id) {
                //Pego o ultimo ID e acresento + 1
                $ultimoId = $id->id + 1;
            }
        }

        //Pego o tamanho da imagem
        $size = getimagesize($input_image);

        //Converto a largura e tamanho para 20% a menos  
        $x = $size[0] - (20 * $size[0] / 100);
        $y = $size[1] - (10 * $size[0] / 100);

        //Converto meus dados convertidos em inteiro
        $x_convert = (int) $x;
        $y_convert = (int) $y;                

        //Crio uma nova largura e tamanho
        $newDimension = array($x_convert ,$y_convert);        
        
        //Pego o nome do arquivo
        $fileName =  $input_image->getClientOriginalName();

        //Pega o tamanho da string
        $tamanhoName = strlen($fileName);
        
        //Tiro a extenção
        $somaName = $tamanhoName - 4;
        
        //Troco a extensão antiga pela que eu quero
        $fileName = substr($fileName, 0 , $somaName );

        //Faço a alteração do formato do arquivo
        if($parameter == 1 or $parameter == '3'){
            $newFileName = $ultimoId . '-' . $fileName .'.jpg';  
            $newFileNameMinitiatura = $ultimoId . '-' . $fileName .'.jpg';      
        }
        
        if($parameter == 2 or $parameter == '4' ){
            $newFileName = $lastIdRequest . '-' . $fileName .'.jpg';  
            $newFileNameMinitiatura = $lastIdRequest . '-' . $fileName .'.jpg';  

        }
        
        //Crio onde quero salvar meu novo arquivo        
        $path = public_path("storage/" . $newFileName);  
        
        //Crio o caminho da miniatura
        if($parameter == 3 or $parameter == '4'){
            $pathMiniatura = public_path("storage/Miniaturas/" . $newFileName);  
        }
        
        //Faço a criação do arquivo        
        $file = Image::make($input_image)->resize($newDimension[0], $newDimension[1])->save($path);

        //Faço a criação da miniatura
        if($parameter == '3' or $parameter == '4'){
            $fileMiniatura = Image::make($input_image)->resize('60', '60')->save($pathMiniatura);

            return $newFileNameMinitiatura;
        }else{
            return $newFileName;
        }


    }


    public function store(Request $request)
    {
        //Configurações json
        $dados = $request->all();

        $equipamentos = \App\Carros::create($dados);
            
        if($equipamentos){
            return response()->json(['data' => $equipamentos, 'status' => true]);
        }else{
            return response()->json(['data' => 'Erro ao adicionar', 'status' => false]);

        }        
                
    }

    public function show($id)
    {
        $dados = \App\Carros::find($id);

        return response()->json(['data' => $dados]);

    }
    public function salvar(Request $request)
    {
        
        //Instancio a Classe 
        $carrosClass = new ControllerCarros();
        
        //Pego todos input exceto o Token
        $inputs = $request->except('_token');
        
        //Pego só o input da imagem
        $input_image = $request->file('imagem');

        //Pego a quantidade de arquivos 
        $cont = count($input_image);

        //Defino a posição 0
        $pos = 0;
        
        if($cont == 1){
            //Verifica se a imagem não está vazia
            if(!empty($input_image)){

                //Pega a entensão do arquivo
                $tipo_arquivo = $request->file('imagem')[$pos]->getClientOriginalExtension();

                //Pega o tamanho do arquivo
                $tamanho_arquivo = $request->file('imagem')[$pos]->getClientSize(); 

                //Verifica tamanho do arquivo na função getTamanhoMaximo
                if($tamanho_arquivo >  10000000){
                    $carrosClass->getTamanhoMaximo($tamanho_arquivo); 
                    
                    return redirect()->route('carros.adicionar');

                }
                
                //Cria um array dos tipos validos que queremos
                $tipos_validos = array('png','jpg', 'JPG', 'jpeg');

                //Chama a função e passa dois parametros
                $validateExtension = $carrosClass->getExtensaoValida($tipo_arquivo, $tipos_validos);

                //Se função retornar true arquivo valido
                if($validateExtension == true){
                    $ok = "Entensão valida";

                }else{
                    return redirect()->route('carros.adicionar');
                }            
            
            }  
        }      
        
        //Cria um array de validação dos input do html
        $validatedData = array(
            'marca' => 'required',
            'modelo' => 'required',
            'ano' =>    'required'           
        );

        //Cria a validação
        $validator = Validator::make($inputs, $validatedData);    

        //$key = array_search(null, $inputs);

        //Verifica se a validação falhar        
        if ($validator->fails()){

            \Session::flash('flash_message',[
                "msg" => "Existem campos vazio",
                "class" => "alert-danger"
            ]);

            return redirect()->route('carros.adicionar');

        }else{

            //Instacia o model carros e começa as alterações pelo input
            $carros = new \App\Carros;
            $carros->marca = $request->marca;
            $carros->modelo = $request->modelo;
            $carros->ano = $request->ano;

            //Verifica se tem arquivo imagem na request
            if ($request->hasFile('imagem')) {                       
                
                $parameter = 1;

                if($cont >= 1){
                    while ($pos < $cont){

                        if($pos == $cont){
                            echo "acabou";
                        }
                        
                        $file = $carrosClass->getAlteraImagem($input_image[$pos], $parameter); 
                        
                        $fileMiniatura = $carrosClass->getAlteraImagem($input_image[$pos], '3');     

                        $carros->imagem = 'storage/'. $file ;

                        $carros->img_miniatura = 'storage/Miniaturas/'. $file ;

                        DB::insert("INSERT into dbo.carros(marca,modelo,ano,created_at, updated_at,imagem,img_miniatura,id_peritagem) values ('$carros->marca', '$carros->modelo', '$carros->ano', GETDATE(), GETDATE(), '$carros->imagem', '$carros->img_miniatura', 242 )");
                        
                        $pos = $pos + 1;
                    }
                }else{                
                    //Chama função e retorna o nome do arquivo editado                
                    $file = $carrosClass->getAlteraImagem($input_image, $parameter);
                    $fileMiniatura = $carrosClass->getAlteraImagem($input_image, '3');

                    /*$teste =  copy("../storage/app/public/$file", "C:/Users/guilherme.o/Pictures/Estetica/$file");

                    dd($teste);*/

                    $carros->imagem = 'storage/'. $file ;
                    $carros->img_miniatura = 'storage/Miniaturas/'. $file ;

                    $carros->save();

                }
                
            }

            \Session::flash('flash_message',[
                "msg" => "Equipamento salvo com sucesso",
                "class" => "alert-success"
            ]);

            return redirect()->route('carros.index');
                
        }
    } 
    
    public function editar(Request $request){

        //Pega o ID da requisição
        $id = $request->id;      
        
        //Busca o ID na model
        $registro = \App\Carros::find($id);

        return view('carros.editar', compact('registro'));
    }

    public function atualizar(Request $request, $id)
    {           
        $carrosClass = new ControllerCarros;

        $input_image = $request->all();
        
        $carros = \App\Carros::find($id);

        $carros->marca = $request->marca;
        $carros->modelo = $request->modelo;
        $carros->ano = $request->ano;

        if($request->hasFile("imagem")){
            if (file_exists($carros->imagem)){
                unlink($carros->imagem);
            }

            if(file_exists($carros->img_miniatura)){
                unlink($carros->img_miniatura);
            }

            //Defino o parametro 2            
            $parameter = 2;    

            //Chamo a função para alterar a imagem
            $file = $carrosClass->getAlteraImagem($input_image, $parameter);

            //Chamo a função para alterar a miniatura
            $fileMiniatura = $carrosClass->getAlteraImagem($input_image, '4');

            //Salvo o caminho da imagem
            $carros->imagem = 'storage/'. $file ;

            //Salvo o caminho da miniatura
            $carros->img_miniatura = 'storage/Miniaturas/'. $fileMiniatura ;

        }
        
        $carros->save();
        
        \Session::flash('flash_message', [
            'msg' => 'Alterado com sucesso',
            'class' => 'alert-success'
        ]);
        
        return redirect()->route('carros.index');
    }
    
    public function deletar(Request $request, $id)
    {
        $registro = \App\Carros::find($id);

        if(empty($registro)){

            \Session::flash('flash_message', [
                'msg' => 'Erro ao deletar',
                'class' => 'alert-danger'
            ]);
            
            return redirect()->route('carros.index');

        }else{
            if (file_exists($registro->imagem)){
                unlink($registro->imagem);
            }

            if(file_exists($registro->img_miniatura)){
                unlink($registro->img_miniatura);
            }

            $registro->delete($registro);

            \Session::flash('flash_message', [
                'msg' => 'Deletado com sucesso',
                'class' => 'alert-success'
            ]);
            
            return redirect()->route('carros.index');
        }
    }

    public function pesquisar(Request $request){
        
        $arrayValidate = array(
            "id" => $request->id,
            "nf" => $request->nf
        );

        $validate = array_search(!null, $arrayValidate);

        if($validate == 'id'){
            $id = intval($request->id);
            if($id == 0){
                \Session::flash('flash_message',[
                    "msg" => "São permitidos apenas numeros no campo do ID",
                    "class" => "alert-danger"
                ]);

                return redirect()->route('carros.index');
            }
            $registro = \App\Carros::where('id' , $id)->paginate(1);

            $contador = count($registro->items());            

            if($contador == 0){
                \Session::flash('flash_message',[
                    "msg" => "Nenhum registro encontrado",
                    "class" => "alert-danger"
                ]);

                return redirect()->route('carros.index');
            }else{
                $carros = $registro;

                return view('carros.index', compact('carros'));
            }
        }
        
        if( $validate == "nf"){
            $nf = $request->nf;

            $carros = \App\Carros::where('marca', 'like' , "%$nf%")->paginate(100);

            $contador = count($carros);

            if($contador == 0){
                \Session::flash('flash_message',[
                    'msg' => 'Nenhum registro encontrado',
                    'class' => 'alert-danger'
                ]);
                
                return redirect()->route('carros.index');
            }

            return view('carros.index', compact('carros'));
        }
    }
    
        
}


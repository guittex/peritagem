<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Validator;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

class ControllerCarros extends Controller
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
    
    }

    public function index()
    {
        $carros = \App\Carros::paginate(12);


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

        if($parameter == 2){
            $lastIdRequest = $input_image['id'];
            $input_image = $input_image['imagem'];
        }

        if($parameter == 1){
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
        if($parameter == 1){
            $newFileName = $ultimoId . '-' . $fileName .'.jpg';    
        }
        
        if($parameter == 2){
            $newFileName = $lastIdRequest . '-' . $fileName .'.jpg';  
        }
        
        //Crio onde quero salvar meu novo arquivo        
        $path = public_path("public/" . $newFileName);              
        
        //Faço a criação do arquivo        
        Image::make($input_image)->resize($newDimension[0], $newDimension[1])->save($path);
        
        return $newFileName;

    }


    public function store(Request $request)
    {
        //Configurações json
        $dados = $request->all();

        $equipamentos = \App\Carros::create($dados);
            
        if($equipamentos){
            return response()->json(['data' => $equipamentos, 'status' => true]);
        }else{
            return response()->json(['data' => 'Erro ao adicionaro', 'status' => false]);

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

        //Verifica se a imagem não está vazia
        if(!empty($input_image)){

            //Pega a entensão o arquivo
            $tipo_arquivo = $request->file('imagem')->getClientOriginalExtension();

            //Pega o tamanho do arquivo
            $tamanho_arquivo = $request->file('imagem')->getClientSize(); 

            //Verifica tamanho do arquivo na função getTamanhoMaximo
            if($tamanho_arquivo >  10000000){
                $carrosClass->getTamanhoMaximo($tamanho_arquivo); 
                
                return redirect()->route('carros.adicionar');

            }
            
            //Cria um array dos tipos validos que quero
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
                
                //Chama função e retorna o nome do arquivo editado
                $file = $carrosClass->getAlteraImagem($input_image, $parameter);

                $carros->imagem = 'public/'. $file ;

            }

            $carros->save();

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
            
            $parameter = 2;            
            $file = $carrosClass->getAlteraImagem($input_image, $parameter);
            $carros->imagem = 'public/'. $file ;
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
        
            $registro->delete($registro);

            \Session::flash('flash_message', [
                'msg' => 'Deletado com sucesso',
                'class' => 'alert-success'
            ]);
            
            return redirect()->route('carros.index');
        }
    }
    
        
}


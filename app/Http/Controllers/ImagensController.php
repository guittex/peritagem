<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

class ImagensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        public function getAlteraImagem($input_image , $parameter,$ID_Peritagem,$ID_Item){

        //Parametros chamados pela função de editar imagem
        if($parameter == 2 or $parameter == '4'){
            $lastIdRequest = $input_image['id'];
            $input_image = $input_image['imagem'];            
        }

        //Parametros chamado pela função adicionar
        if($parameter == 1 or $parameter == '3'){
            //Pego o ultimo ID do model
            $lastId = \App\Imagens::orderBy('ID_Img', 'desc')
                                        ->take(1)
                                        ->get();
            if(count($lastId) == 0){
                $ultimoId = 1;
            }else{
                //Percorre os registro
                foreach ($lastId as $id) {
                    //Pego o ultimo ID e acresento + 1
                    
                    $ultimoId = $id->ID_Img + 1;
                }
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
            $newFileName = 'ID' . $ultimoId . '-' . 'Item' . $ID_Item . '-' . 'P'. $ID_Peritagem .'.jpg';
            $newFileNameMinitiatura = 'ID' . $ultimoId . '-' . 'Item' . $ID_Item . '-' . 'P'. $ID_Peritagem .'.jpg';   
        }
        
        //Troca de nome quando atualiza imagem
        if($parameter == 2 or $parameter == '4' ){
            $newFileName = $lastIdRequest . '-' . $fileName .'.jpg';  
            dd($ID_Item);
            $newFileNameMinitiatura = $lastIdRequest . '-' . $ID_Item .'.jpg';  

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
            $fileMiniatura = Image::make($input_image)->resize('200', '100')->save($pathMiniatura);

            return $newFileNameMinitiatura;
        }else{
            return $newFileName;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Instancio a Classe 
        $imagensClass = new ImagensController();
        
        //Pego todos input exceto o Token
        $inputs = $request->except('_token');
        
        //Pego só o input da imagem
        $input_image = $request->file('ImageInput');
        
        //Pego a quantidade de arquivos 
        $cont = count($input_image);

        //Defino a posição 0
        $pos = 0;
        
        if($cont == 1){
            //Verifica se a imagem não está vazia
            if(!empty($input_image)){

                //Pega a entensão do arquivo
                $tipo_arquivo = $request->file('ImageInput')[$pos]->getClientOriginalExtension();

                //Pega o tamanho do arquivo
                $tamanho_arquivo = $request->file('ImageInput')[$pos]->getClientSize(); 

                //Verifica tamanho do arquivo na função getTamanhoMaximo
                if($tamanho_arquivo >  10000000){
                    $imagensClass->getTamanhoMaximo($tamanho_arquivo); 
                    
                    return redirect()->route('itens.index');

                }
                
                //Cria um array dos tipos validos que queremos
                $tipos_validos = array('png','jpg', 'JPG', 'jpeg');

                //Chama a função e passa dois parametros
                $validateExtension = $imagensClass->getExtensaoValida($tipo_arquivo, $tipos_validos);

                //Se função retornar true arquivo valido
                if($validateExtension == true){
                    $ok = "Entensão valida";

                }else{
                    return redirect()->route('itens.index');
                }            
            
            }  
        }      
        
        //Cria um array de validação dos input do html
        /*$validatedData = array(
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

        }else{*/

        //Instacia o model carros e começa as alterações pelo input
        $imagem = new \App\Imagens;
        $imagem->ID_Item = $request->idItem;     
        $imagem->ID_ImgPeritagem = $request->idPeritagem;
        $imagem->Label = $request->label;                
        $imagem->Descricao = $request->descricao;
        
        //Verifica se tem arquivo imagem na request
        if ($request->hasFile('ImageInput')) {                       
            
            $parameter = 1;

            if($cont >= 1){
                while ($pos < $cont){

                    if($pos == $cont){
                        echo "acabou";
                    }
                    
                    $file = $imagensClass->getAlteraImagem($input_image[$pos], $parameter, $imagem->ID_ImgPeritagem, $imagem->ID_Item); 
                    
                    $fileMiniatura = $imagensClass->getAlteraImagem($input_image[$pos], '3', $imagem->ID_ImgPeritagem, $imagem->ID_Item);     

                    $imagem->Path_Img = 'storage/'. $file ;

                    $imagem->Path_Miniatura = 'storage/Miniaturas/'. $file ;

                    DB::insert("INSERT into dbo.PRT_Imagens(ID_Item,ID_ImgPeritagem,Label,Descricao,Path_Miniatura, Path_Img, Criado_em) values ($imagem->ID_ImgPeritagem, $imagem->ID_ImgPeritagem, '$imagem->Label', '$imagem->Descricao', '$imagem->Path_Miniatura', '$imagem->Path_Img', GETDATE() )");
                    
                    $pos = $pos + 1;
                }
            }else{                
                //Chama função e retorna o nome do arquivo editado                
                $file = $imagensClass->getAlteraImagem($input_image, $parameter, $imagem->ID_ImgPeritagem, $imagem->ID_Item);
                $fileMiniatura = $imagensClass->getAlteraImagem($input_image, '3', $imagem->ID_ImgPeritagem, $imagem->ID_Item);

                /*$teste =  copy("../storage/app/public/$file", "C:/Users/guilherme.o/Pictures/Estetica/$file");

                dd($teste);*/

                $imagem->Path_Img = 'storage/'. $file ;
                $imagem->Path_Miniatura = 'storage/Miniaturas/'. $file ;

                $imagem->save();

            }
            
        }

        \Session::flash('flash_message',[
            "msg" => "Imagem salvo com sucesso",
            "class" => "alert-success"
        ]);

        return redirect()->route('itens.index', $request->idPeritagem);
            
        /*}*/
    }

    public function setImagePrincipal($id)
    {
        $peritagem = \App\Imagens::find($id);
        
        $ID_Peritagem = $peritagem->ID_ImgPeritagem;

        $updateZerar = DB::update("UPDATE dbo.PRT_Imagens set ImagemPrincipal = 0 where ID_ImgPeritagem = $ID_Peritagem");

        $registro = DB::update("UPDATE dbo.PRT_Imagens set ImagemPrincipal = 1 where ID_Img = $id");

        if($registro >= 1){
            \Session::flash('flash_message',[
                'msg' => 'Definido imagem com sucesso',
                'class' => 'alert-success'
            ]);

            return redirect()->route('peritagem.index');
        }else{
            \Session::flash('flash_message',[
                'msg' => 'Ocorreu um erro',
                'class' => 'alert-danger'
            ]);

            return redirect()->route('peritagem.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

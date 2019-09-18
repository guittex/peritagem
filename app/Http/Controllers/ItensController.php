<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Validator;


class ItensController extends Controller
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

    public function validateInput($request, $id){

        $inputs = $request->except('_token');

        //Cria um array de validação dos input do html
        $validatedData = array(
            'label' => 'required|max:200',
            'condicao' => 'required',
            'medidas' => 'required',
            'material' => 'required|max:254',
            'dureza' => 'required',
            'trat_termico' => 'required|integer',
            'peso' => 'required',
            'n_dentes' => 'required|integer',
            'ang_helice' => 'required',
            'sentido' => 'required|max:50',
            'ang_pressao' => 'required',
            'descricao' => 'required|max:2000'            
        );

        //Cria a validação
        $validator = Validator::make($inputs, $validatedData);    

        $arrayError = $validator->errors()->messages();
        
        //Verifica se a validação falhar        
        if ($validator->fails()){

            $arrayError = $validator->errors()->messages();

            //Percorro o array de erro
            foreach($arrayError as $errors){
                //Pego a mensagem de erro
                $errors = $errors[0];

                return array(false, $errors);
            }
        }else{
            return true;
        }
    }

    public function convertDecimal($array){

        foreach($array as $key => $value){
            $NumDecimal[] = floatval($value);
    
            
        }
        return $NumDecimal;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validate = ItensController::validateInput($request, $id);
        
        if(is_array($validate) == true ){
            //Gravo uma seção com a mensagem de erro
            \Session::flash('flash_message',[
                "msg" => "$validate[1]",
                "class" => "alert-danger"
            ]);

            //Volto para rota
            return redirect()->route("$request->rota", $id);
        }

        $arrayConvertDecimal = array(
                                'medidas' => $request->medidas, 
                                'dureza' => $request->dureza, 
                                'peso' => $request->peso, 
                                'ang_helice' => $request->ang_helice,
                                'ang_pressao' => $request->ang_pressao,
                                'w' => $request->w,
                                'w2' => $request->w2,
                                'modulo' => $request->modulo
                        );

        $ValueDecimal = ItensController::convertDecimal($arrayConvertDecimal);
        
        $medidas = $ValueDecimal[0];
        $dureza = $ValueDecimal[1];
        $peso = $ValueDecimal[2];
        $ang_helice = $ValueDecimal[3];
        $ang_pressao = $ValueDecimal[4];
        $w = $ValueDecimal[5];
        $w2 = $ValueDecimal[6];
        $modulo = $ValueDecimal[7];

        $save = DB::insert("INSERT into dbo.PRT_Itens(Descricao, Condicao, Medidas, Material,Dureza,Trat_Termico,Peso,Z,Ang_Helice,Sentido
                    ,Ang_Pressao,W,W2,Modulo,Detalhes, DT_Cria,ID_Peritagem, Ordem, ID_TipoItem) VALUES ('$request->label',$request->condicao, $medidas,
                                            '$request->material',$dureza, $request->trat_termico,$peso,$request->n_dentes,$ang_helice,
                                            '$request->sentido',$ang_pressao,$w,$w2,$modulo, '$request->descricao', GETDATE(), $id, 10, $request->ID_TipoItem ) ");            
        if($save == true){
            \Session::flash('flash_message',[
                'msg' => 'Salvo com sucesso',
                'class' => 'alert-success'
            ]);

            return redirect()->route("$request->rota", $id);
        }else{
            \Session::flash('flash_message',[
                'msg' => 'Não foi possível salvar',
                'class' => 'alert-danger'
            ]);

            return redirect()->route("$request->rota", $id);
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
        //$registro = DB::select("SELECT * FROM dbo.PRT_Peritagem WHERE ID_Peritagem = $id");
        $registro = \App\Itens::where('ID_Peritagem', $id)->get();
        //$registro = \App\Itens::where('ID_Peritagem', '182')->get();

        $peritagem = \App\Peritagem::find($id);

        return view('itens.index', compact('registro', 'peritagem'));
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
        /*$registro = \App\Itens::find($id);
        dd($registro);
        $delete = $registro->delete();

        if($delete == true){
            \Session::flash('flash_message',[
                'msg' => 'Apagado com sucesso',
                'class' => 'alert-success'
            ]);

            return redirect()->route('peritagem.index');
        }else{
            \Session::flash('flash_message',[
                'msg' => 'Erro ao apagar',
                'class' => 'alert-danger'
            ]);

            return redirect()->route('peritagem.index');
        }*/
    }

    public function pesquisar(Request $request){
        $idPeritagem = $request->idPeritagem;

        $validateArray = array(
            "id" => $request->id,
            "descricao" => $request->descricao
        );

        $validate = array_search(!null, $validateArray);
        
        if($validate == false){
            \Session::flash('flash_message',[
                'msg' => 'Necessário digitar algo',
                'class' => 'alert-danger'
            ]);

            return redirect()->route('itens.index',$idPeritagem);
        }

        if($validate == 'id'){
            $id = intval($request->id);
            
            $registro = DB::select("SELECT * FROM dbo.PRT_ITENS WHERE ID_Item = $id and ID_Peritagem = $idPeritagem");
            $peritagem = \App\Peritagem::find($idPeritagem);

            if(count($registro) == 0){
                \Session::flash('flash_message',[
                    'msg' => 'Nenhum registro encontrado',
                    'class' => 'alert-danger'
                ]);

                return redirect()->route('itens.index',$idPeritagem);
            }

            return view('itens.index',compact('registro', 'peritagem'));

        }

        if($validate == 'descricao'){
            $registro = DB::select("SELECT * FROM dbo.PRT_ITENS WHERE Descricao like '%$request->descricao%' and ID_Peritagem = $idPeritagem");
            $peritagem = \App\Peritagem::find($idPeritagem);

            if(count($registro) == 0){
                \Session::flash('flash_message',[
                    'msg' => 'Nenhum registro encontrado',
                    'class' => 'alert-danger'
                ]);

                return redirect()->route('itens.index',$idPeritagem);
            }

            return view('itens.index',compact('registro', 'peritagem'));
        }

    }

    public function ParCilindricoPinhaoIndex($id){

        $registro = \App\Itens::where('ID_Peritagem', $id)->where('ID_TipoItem',1)->get();

        $peritagem = \App\Peritagem::find($id);

        return view('itens.ParCilindricoPinhao', compact('registro', 'peritagem'));
    }

    public function ParCilindricoEngrenagemIndex($id){
        $registro = \App\Itens::where('ID_Peritagem', $id)->where('ID_TipoItem',2)->get();

        $peritagem = \App\Peritagem::find($id);

        return view('itens.ParCilindricoEngrenagem', compact('registro', 'peritagem'));
    }

    public function EngrenagemInternaIndex($id){
        $registro = \App\Itens::where('ID_Peritagem', $id)->where('ID_TipoItem', 3)->get();

        $peritagem = \App\Peritagem::find($id);

        return view('itens.EngrenagemPlanetario', compact('registro', 'peritagem'));
    }

    public function ParConicoPinhaoIndex($id){
        $registro = \App\Itens::where('ID_Peritagem', $id)->get();

        $peritagem = \App\Peritagem::find($id);

        return view('itens.ParConicoPinhao', compact('registro', 'peritagem'));
    }

    public function teste(){
        return view('itens.teste');
    }
}

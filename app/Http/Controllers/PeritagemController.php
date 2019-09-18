<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use DateTime;

class PeritagemController extends Controller
{

    public function getDateFormat($date){
        $data = new DateTime($date);
        
        $dataFormat = $data->format('Y-m-d H:i:s');

        return $dataFormat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registro = \App\Peritagem::orderby('ID_Peritagem', 'desc')->paginate(10);
                
        return view('peritagem.index', compact('registro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('peritagem.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $peritagem = new \App\Peritagem;

        $user = Auth::user()->name;

        $peritagem->DT_CRIA = date('Y-m-d H:i:s');

        $peritagem->ID_Cliente = $request->cliente;

        $peritagem->Usuario_Cria = $user;

        //$peritagem->DT_Prevista = PeritagemController::getDateFormat($request->dt_prevista);

        $peritagem->Descricao = $request->descricao;

        $peritagem->Detalhes = $request->detalhes;

        $peritagem->ID_Situacao = 0;

        $peritagem->Nota_Fiscal = $request->Nota_Fiscal;

        $peritagem->DT_Prazo = PeritagemController::getDateFormat($request->DT_Prazo);

        $peritagem->DT_Entrada = PeritagemController::getDateFormat($request->DT_Entrada);

        $peritagem->DT_Recebimento = PeritagemController::getDateFormat($request->DT_Recebimento);

        $peritagem->Protocolo = $request->Protocolo;

        $peritagem->Referencia = $request->Referencia;

        $peritagem->ID_Tipo = $request->ID_Tipo;

        $peritagem->Aplicacao = $request->Aplicacao;

        $peritagem->Motivo_Manutencao = $request->Motivo_Manutencao;

        $peritagem->N_Contrato = $request->N_Contrato;

        $peritagem->Setor = $request->Setor;

        $save = $peritagem->save();

        if($save == true){
            \Session::flash('flash_message',[
                'msg' => 'Adicionado com sucesso',
                'class' => 'alert-success'
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
    public function show(Request $request)
    {   
        //Verifico se os campos estão todos vazio
        if($request->Nota_Fiscal == null and $request->descricao == null and $request->Nome == null)
        {
            //Gravo um sessão de erro
            \Session::flash('flash_message',[
                'msg' => 'Necessário digitar algo para pesquisar',
                'class' => 'alert-danger'
            ]);
            //Retorno para o index
            return redirect()->route('peritagem.index');
        }

        //Crio um array com chaves e valores do request
        $arrayValidate = array(
            'Nota_Fiscal' => $request->Nota_Fiscal,
            'algo' => $request->descricao,
            'Nome' => $request->Nome
        );

        //Verifico qual campo do array está nulo
        $validate = array_search(!null, $arrayValidate);
        
        //Se o array retornar id
        if($validate == "Nota_Fiscal"){
            //Converto os dados da requisição id para Inteiros
            $nota = intval($request->Nota_Fiscal);

            //Se o campo ID for digitado caracteres
            if($nota == 0){
                //Gravo uma seção de erro 
                \Session::flash('flash_message',[
                    'msg' => 'Campo da Nota só é permitido números inteiros',
                    'class' => 'alert-danger'
                ]);
                //Retorno para rota
                return redirect()->route('peritagem.index');
            }

            //Faço a pesquisa do id
            $registro = \App\Peritagem::where('Nota_Fiscal','like',"%$nota%")->paginate(100);

            //Se não encontrar nenhum registro
            if(count($registro) == 0){
                //Gravo uma seção de erro
                \Session::flash('flash_message',[
                    'msg' => 'Nenhum registro encontrado',
                    'class' => 'alert-danger'
                ]);
                //Retorno para a rota
                return redirect()->route('peritagem.index');        
            }    

            //Retorno para rota passando a consulta sql
            return view('peritagem.index', compact('registro'));
        }

        if($validate == "algo"){
            //Faço a pesquisa do descricao
            $registro = \App\Peritagem::where('Descricao','like', "%$request->descricao%")->paginate(100);

            //Se não encontrar nenhum registro
            if(count($registro) == 0){
                //Gravo uma seção de erro
                \Session::flash('flash_message',[
                    'msg' => 'Nenhum registro encontrado',
                    'class' => 'alert-danger'
                ]);
                //Retorno para a rota
                return redirect()->route('peritagem.index');        
            }    

            //Retorno para rota passando a consulta sql
            return view('peritagem.index', compact('registro'));           
        }

        if($validate == "Nome"){
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        echo('oi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $registro = \App\Peritagem::find($request->id);
        $registro->Usuario_Revisa = Auth::user()->name;
        $registro->DT_Revisa = date('Y-m-d h:i:s');
        $registro->Descricao = $request->descricao;
        $registro->Detalhes = $request->detalhes;
        $registro->Nota_Fiscal = $request->Nota_Fiscal;
        $registro->DT_Prazo = $request->DT_Prazo;
        $registro->DT_Entrada = $request->DT_Entrada;
        $registro->DT_Recebimento = $request->DT_Recebimento;
        $registro->Protocolo = $request->Protocolo;
        $registro->Referencia = $request->Referencia;
        $registro->ID_Tipo = $request->ID_Tipo;
        $registro->Aplicacao = $request->Aplicacao;
        $registro->Motivo_Manutencao= $request->Motivo_Manutencao;
        $registro->N_Contrato = $request->N_Contrato;
        $registro->Setor = $request->Setor;

        $save = $registro->save();


        if($save == true){
            \Session::flash('flash_message',[
                'msg' => 'Alterado com sucesso',
                'class' => 'alert-success'
            ]);
            
            return redirect()->route('peritagem.index');
        }else{
            \Session::flash('flash_message',[
                'msg' => 'Erro ao alterar entre em contato com o TI',
                'class' => 'alert-danger'
            ]);
            
            return redirect()->route('peritagem.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = \App\Peritagem::find($id);

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
        }
    }

    public function PesquisarAjax(Request $request)
    {
        if($request->Situacao == 'Pendente'){
            $registro = \App\Peritagem::where('ID_Situacao', 20)->orderby('ID_Peritagem', 'desc')->get();
            foreach($registro as $array){
                $imagem = getCroqui($array->ID_Peritagem);
                echo    "<tr>";   
                echo        "<td>$array->ID_Peritagem</td>";
                echo        "<td><img src='".$imagem."' style='width:80px;border-radius:15px'/></td>";
                echo        "<td>$array->ID_Cliente</td>";
                echo        "<td>$array->Nota_Fiscal</td>";
                echo        "<td>$array->Descricao</td>";
                echo        "<td>$array->Detalhes</td>";
                echo        "<td style='color:".getCorSituacao($array->ID_Situacao)."'>".getSituacao($array->ID_Situacao)."</td>"; 

                echo    "</tr>";
            }
            //echo $registro->Detalhes;
        }
    }

    public function Pendente()
    {
        $registro = \App\Peritagem::where('ID_Situacao', 0)->orderby('ID_Peritagem', 'desc')->paginate(10);
                
        return view('peritagem.index', compact('registro'));
    }

    public function Processo()
    {
        $registro = \App\Peritagem::where('ID_Situacao', 10)->orderby('ID_Peritagem', 'desc')->paginate(10);
                
        return view('peritagem.index', compact('registro'));
    }

    public function Revisado()
    {
        $registro = \App\Peritagem::where('ID_Situacao', 20)->orderby('ID_Peritagem', 'desc')->paginate(10);
                
        return view('peritagem.index', compact('registro'));
    }

}

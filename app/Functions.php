<?php

use Illuminate\Support\Facades\DB;

function getCroqui($id){
    $registro = DB::select("SELECT * from dbo.PRT_Imagens where ID_ImgPeritagem = $id and ImagemPrincipal = 1 ");
    
    foreach($registro as $array){
        echo $array->Path_Miniatura;
    }
}

function getPath_Image($id){

    $imagem = DB::select("SELECT * from dbo.PRT_Imagens where ID_ImgPeritagem = $id");

    foreach($imagem as $array){
        echo    '<div class="col-lg-3 col-md-4 col-sm-6 col-12 text-center">';
        echo        '<div class="container2">';  
        echo            "<img src='http://192.168.1.6:8089/peritagem/public/$array->Path_Miniatura' class='b-r-25 image ' >";
        echo            "<p>$array->Label</p>";
        echo            "<div class='overlay'>";
        echo                "<a href='http://192.168.1.6:8089/peritagem/public/$array->Path_Img'>";
        echo                "<div class='text'>$array->Descricao  </div>";
        echo                "</a>";
        echo            "</div>";
        echo         '</div>';
        echo    '</div>';
    }
}

function setImagePrincipal($id){
    $imagem = DB::select("SELECT * from dbo.PRT_Imagens where ID_ImgPeritagem = $id");

    foreach($imagem as $array){
        echo    '<div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center">';
        echo            "<a href=".route('imagens.principal', $array->ID_Img)."><img src='http://192.168.1.6:8089/peritagem/public/$array->Path_Miniatura' class='b-r-25 image ' style='margin:10px'></a>";
        echo    '</div>';
    }
}

function getDateFormat($date)
{
    $data = new DateTime($date);
    
    $dataFormat = $data->format('d/m/Y');

    return $dataFormat;
}

function getCorSituacao($id)
{
    if($id == 0){
        $cor = 'red';
        
        return $cor;
    }

    if($id == 10){
        $cor = 'yellow';

        return $cor;        
    }

    if($id == 20){
        $cor = "green";

        return $cor;
    }
}

function getSituacao($id){
    if($id == 0){
        $situacao = 'Pendente';

        return $situacao;
    }
    if($id == 10){
        $situacao = 'Em processo';

        return $situacao;
    }
    if($id == 20){
        $situacao ="Revisado";

        return $situacao;
    }    
}
?>
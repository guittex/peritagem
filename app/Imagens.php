<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    protected $table = "dbo.PRT_Imagens";

    protected $primaryKey  = "ID_Img";

    public $timestamp = false;

    protected $fillable = [
        'ID_ImgPeritagem',
        'ID_Item',
        'Ordem',
        'Label',
        'Descricao',
        'Path_Miniatura',
        'Path_Img'
    ];
}

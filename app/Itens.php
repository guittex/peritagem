<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    protected $table = "dbo.PRT_Itens";

    protected $primaryKey  = "ID_Item";

    public $timestamp = false;

    protected $fillable = [
        'Order',
        'Descricao',
        'Detalhes',
        'Conclusao',
        'Usuario_Cria',
    ];
}

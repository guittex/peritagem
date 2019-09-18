<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peritagem extends Model
{
    protected $table = "PRT_Peritagem";

    protected $fillable = [
        'Usuario_Cria',
        'Usuario_Revisa',
        'Descricao',
        'Detalhes'
    ];

    public $timestamps  = false;

    protected $primaryKey = 'ID_Peritagem';
}

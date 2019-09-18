<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    protected $fillable = ['marca','modelo','ano','imagem', 'img_miniatura'];

    protected $primarykey = "id";

}

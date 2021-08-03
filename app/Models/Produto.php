<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['id','codigo','nome','quantidade','tipo_de_quantidade','peso','tipo_de_peso','fabricante','preco'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
}

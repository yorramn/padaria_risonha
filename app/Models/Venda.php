<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $casts = [
        'codigos' => 'array',
        'nomes' => 'array',
        'precos' => 'array',
        'quantidade_itens' => 'array'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function promocao(){
        return $this->hasOne('App\Models\Promocao');
    }
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}

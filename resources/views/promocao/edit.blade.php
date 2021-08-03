@extends('layouts.main')
@section('title','Editando promoção '.$promocao->codigo)
@section('content')
<div class="section">
    <div class="row">
        <form action="/promocao/update/{{$promocao->id}}" class="col s12" method="PUT">
            @csrf
            @method('PUT')
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="codigo" type="text" class="validate" name="codigo" value="{{$promocao->codigo}}">
                <label for="codigo">Código</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <textarea name="descricao" id="descricao" class="materialize-textarea">{{$promocao->descricao}}</textarea>
                <label for="descricao">Descrição</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="onde_aplica" type="text" class="validate" name="onde_aplicar" value="{{$promocao->onde_aplicar}}">
                <label for="onde_aplica">Digite o código do alvo da promoção</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <select name="como_aplicar">
                    <option value="" disabled selected>Escolha uma opção</option>
                    <option value="porcentagem" {{$promocao->como_aplicar == "porcentagem" ? "selected = 'selected'" : ""}}>%</option>
                    <option value="valor_bruto" {{$promocao->como_aplicar == "valor_bruto" ? "selected = 'selected'" : ""}}>R$</option>
                </select>
                <label>Escolha como deverá ser aplicado o desconto</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="data_de_validade" type="date" class="validate" name="data_de_validade" value="{{$promocao->data_de_validade}}">
                <label for="data_de_validade">Data de validade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="valor" type="text" class="validate" name="valor" value="{{$promocao->valor}}">
                <label for="valor">Valor do desconto</label>
            </div>
            <div class="col s12 m12 l12 xl12 right-align">
                <a class="btn  waves-effect red">Cancelar</a>
                <a class="btn  waves-effect orange lighten-1">Limpar</a>
                <button type="submit" class="btn  waves-effect green lighten-2">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
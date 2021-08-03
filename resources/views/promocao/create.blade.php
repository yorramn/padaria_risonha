@extends('layouts.main')
@section('title','Cadastrar promoção')
@section('content')
<div class="section">
    <div class="row">
        <form action="/promocao/create" class="col s12" method="POST">
            @csrf
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="codigo" type="text" class="validate" name="codigo">
                <label for="codigo">Código</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
                <label for="descricao">Descrição</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="onde_aplica" type="text" class="validate" name="onde_aplicar">
                <label for="onde_aplica">Digite o código do alvo da promoção</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <select name="como_aplicar">
                    <option value="" disabled selected>Escolha uma opção</option>
                    <option value="porcentagem">%</option>
                    <option value="valor_bruto">R$</option>
                </select>
                <label>Escolha como deverá ser aplicado o desconto</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="data_de_validade" type="date" class="validate" name="data_de_validade">
                <label for="data_de_validade">Data de validade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="valor" type="text" class="validate" name="valor">
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
@extends('layouts.main')
@section('title','Adicionar Produto')
@section('content')
<div class="section">
    <div class="row">
        <form action="/produto/create" class="col s12" method="POST">
            @csrf
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="codigo" type="text" class="validate" name="codigo">
                <label for="codigo">Código</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="nome">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="data_de_validade" type="date" class="validate" name="data_de_validade">
                <label for="data_de_validade">Data de validade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="quantidade" type="number" class="validate" name="quantidade">
                <label for="quantidade">Quantidade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <select name="tipo_de_quantidade">
                    <option value="" disabled selected>Escolha a tipagem da quantidade</option>
                    <option value="un">Unidade</option>
                    <option value="cx">Caixa</option>
                    <option value="lt">Lote</option>
                </select>
                <label>Tipo de Quantidade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="peso" type="text" class="validate" name="peso">
                <label for="peso">Peso</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <select name="tipo_de_peso">
                    <option value="" disabled selected>Escolha a tipagem do peso</option>
                    <option value="kg">KiloGramas</option>
                    <option value="g">Gramas</option>
                    <option value="mg">MiliGramas</option>
                    <option value="l">Litros</option>
                    <option value="ml">MiliLitros</option>
                </select>
                <label>Tipo de Peso</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="fabricante" type="text" class="validate" name="fabricante">
                <label for="fabricante">Fabricante</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="preco" type="text" class="validate" name="preco">
                <label for="preco">Preço</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                @if(count($categorias) > 0)
                <i class="material-icons prefix">account_circle</i>
                <select name="categoria_id">
                    <option value="" disabled selected>Escolha a categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                @else
                    <h5 class="center-align"><a href="/categoria/create"><i class="small material-icons">add</i>Adicionar categoria</a></h5>
                @endif
                </select>
                <P class="right-align"><a href="/categoria/create">Não tem a categoria que busca? Adicione uma</a></P>
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
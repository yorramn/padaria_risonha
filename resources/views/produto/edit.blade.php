@extends('layouts.main')
@section('title','Editando '.$produto->nome)
@section('content')
<div class="row">
    <form action="/produto/update/{{$produto->id}}" class="col s12" method="POST">
        @csrf
        @method('PUT')
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="codigo" type="text" class="validate" name="codigo" value="{{$produto->codigo}}" readonly>
            <label for="codigo">Código</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="nome" type="text" class="validate" name="nome" value="{{$produto->nome}}">
            <label for="nome">Nome</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="data_de_validade" type="date" class="validate" name="data_de_validade" value="{{$produto->data_de_validade}}">
            <label for="data_de_validade">Data de validade</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="quantidade" type="number" class="validate" name="quantidade" value="{{$produto->quantidade}}">
            <label for="quantidade">Quantidade</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <select name="tipo_de_quantidade">
                <option value="" disabled selected>Escolha a tipagem da quantidade</option>
                <option value="un" {{$produto->tipo_de_quantidade == "un" ? "selected = 'selected'" : ""}}>Unidade</option>
                <option value="cx" {{$produto->tipo_de_quantidade == "cx" ? "selected = 'selected'" : ""}}>Caixa</option>
                <option value="lt" {{$produto->tipo_de_quantidade == "lt" ? "selected = 'selected'" : ""}}>Lote</option>
            </select>
            <label>Tipo de Quantidade</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="peso" type="text" class="validate" name="peso" value="{{$produto->peso}}">
            <label for="peso">Peso</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <select name="tipo_de_peso">
                <option value="" disabled selected>Escolha a tipagem do peso</option>
                <option value="kg" {{$produto->tipo_de_peso == "kg" ? "selected = 'selected'" : ""}}>KiloGramas</option>
                <option value="g"  {{$produto->tipo_de_peso == "g" ? "selected = 'selected'" : ""}}>Gramas</option>
                <option value="mg" {{$produto->tipo_de_peso == "mg" ? "selected = 'selected'" : ""}}>MiliGramas</option>
                <option value="l"  {{$produto->tipo_de_peso == "l" ? "selected = 'selected'" : ""}}>Litros</option>
                <option value="ml" {{$produto->tipo_de_peso == "ml" ? "selected = 'selected'" : ""}}>MiliLitros</option>
            </select>
            <label>Tipo de Peso</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="fabricante" type="text" class="validate" name="fabricante" value="{{$produto->fabricante}}">
            <label for="fabricante">Fabricante</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
            <i class="material-icons prefix">account_circle</i>
            <input id="preco" type="text" class="validate" name="preco" value="{{$produto->preco}}">
            <label for="preco">Preço</label>
        </div>
        <div class="input-field col s12 m12 l6 xl6">
                @if(count($categorias) > 0)
                <i class="material-icons prefix">account_circle</i>
                <select name="categoria_id">
                    <option value="" disabled selected>Escolha a categoria</option>
                        @foreach($categorias as $categoria)
                            @if($produto->categoria_id == $categoria->id)
                                <option selected value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @else
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endif
                        @endforeach
                @else
                    <h5 class="center-align"><a href="/categoria/create"><i class="small material-icons">add</i>Adicionar categoria</a></h5>
                @endif
                </select>
                <p class="right-align"><a href="/categoria/create">Não tem a categoria que busca? Adicione uma</a></p>
        </div>
        <div class="col s12 m12 l12 xl12 right-align">
            <a class="btn waves-effect red">Cancelar</a>
            <a class="btn waves-effect orange lighten-1">Limpar</a>
            <button type="submit" class="btn waves-effect green lighten-2">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
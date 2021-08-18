@extends('layouts.main')
@section('title','Buscar')
@section('content')
<form action="/produto/show" method="get" class="col s12">
    <h4 class="title center-align">Pesquisar</h4>
    <div class="row">
        <div class="container">
            <div class="input-field col s9">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="search">
                <label for="nome">Digite o nome do produto</label>
            </div>
            <div class="col s3">
                <button type="submit" class="btn btn-large btn-floating waves wave-effect grey darken-2 left">
                    <i class="material-icons">add</i>
                </button>
            </div>
        </div>
    </div>
</form>
<div class="section">
    @if(isset($produtos))
    <table class="striped centered responsive-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Tipo de Quantidade</th>
                <th>Peso</th>
                <th>Tipo de Peso</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr class="hoverable">
                <td>{{$produto->codigo}}</td>
                <td>{{$produto->nome}}</td>
                <td>{{$produto->quantidade}}</td>
                <td>{{$produto->tipo_de_quantidade}}</td>
                <td>{{$produto->peso}}</td>
                <td>{{$produto->tipo_de_peso}}</td>
                <td>R$ {{$produto->preco}}</td>
                @foreach($categorias as $categoria)
                    @if($produto->categoria_id == $categoria->id)
                        <td>{{$categoria->nome}}</td>
                    @endif
                @endforeach
                @can("update produtos")
                <td><a href="/produto/edit/{{$produto->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                @endcan
                @can("delete produtos")
                <form action="/produto/delete/{{$produto->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <td><button type="submit" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
                </form>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h5 class="title center-align">Digite algo no campo de busca para procurar. <a href="/produto/showAll">Buscar por todos?</a></h5>
    @endif
</div>
@endsection
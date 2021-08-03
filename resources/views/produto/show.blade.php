@extends('layouts.main')
@section('title','Listar todos')
@section('content')
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

            <td><a href="/produto/edit/{{$produto->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
            <form action="/produto/delete/{{$produto->id}}" method="post" name="formValidation">
                @csrf
                @method('DELETE')
                <td><button type="button" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<h6 class="title right-align"><a href="/produto/show">Buscando por algum produto específico?</a></h6>
@endsection
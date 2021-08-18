@extends('layouts.main')
@section('title','Buscar categoria')
@section('content')
<form action="/categoria/show" method="get" class="col s12">
    <h4 class="title center-align">Pesquisar</h4>
    <div class="row">
        <div class="container">
            <div class="input-field col s9">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="search">
                <label for="nome">Digite o nome da categoria desejada</label>
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
    @if(isset($categorias))
    <table class="striped centered responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr class="hoverable">
                    <td>{{$categoria->nome}}</td>
                    <td>{{$categoria->descricao}}</td>
                    @can("update categoria")
                    <td><a href="/categoria/edit/{{$categoria->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                    @endcan
                    @can("delete categoria")
                    <form action="/categoria/delete/{{$categoria->id}}" method="post">
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
        <h5 class="title center-align">Digite algo no campo de busca para procurar. <a href="/categoria/showAll">Buscar por todos?</a></h5>
    @endif
</div>
@endsection
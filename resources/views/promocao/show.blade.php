@extends('layouts.main')
@section('title','Buscar promoção')
@section('content')
<form action="/promocao/show" method="get" class="col s12">
    <h4 class="title center-align">Pesquisar</h4>
    <div class="row">
        <div class="container">
            <div class="input-field col s9">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="search">
                <label for="nome">Digite o nome da promoção desejada</label>
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
    @if(isset($promocoes))
    <table class="striped centered responsive-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Onde se aplica</th>
                <th>Como se aplica</th>
                <th>Valor</th>
                <th>Data de validade</th>
                <th>Registrado por:</th>
            </tr>
        </thead>
        <tbody>
            @if(count($promocoes)>0)
            @foreach($promocoes as $promocao)
            <tr class="hoverable">
                <td>{{$promocao->codigo}}</td>
                <td>{{$promocao->descricao}}</td>
                <td>{{$promocao->onde_aplicar}}</td>
                @if($promocao->como_aplicar == "porcentagem")
                <td>%</td>
                @else
                <td>R$</td>
                @endif
                <td>{{$promocao->valor}}</td>
                <td>{{$promocao->data_de_validade}}</td>
                @foreach($users as $user)
                     @if($promocao->user_id == $user->id)
                        <td>{{$user->name}}</td>
                     @endif
                @endforeach
                @can("update promocao")
                <td><a href="/promocao/edit/{{$promocao->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                @endcan
                @can("delete promocao")
                <form action="/promocao/delete/{{$promocao->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <td><button type="submit" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
                </form>
                @endcan
            </tr>
            @endforeach
            @else
            <h5 class="center-align title">Não há promoções vigentes no momento. Deseja<a href="/promocao/create">criar?</a></h5>
            @endif
        </tbody>
    </table>
    @else
    <h5 class="title center-align">Digite algo no campo de busca para procurar. <a href="/promocao/showAll">Buscar por todos?</a></h5>
    @endif
</div>
@endsection
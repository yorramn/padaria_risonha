@extends('layouts.main')
@section('title','Buscar cliente')
@section('content')
<form action="/cliente/show" method="get" class="col s12">
    <h4 class="title center-align">Pesquisar</h4>
    <div class="row">
        <div class="container">
            <div class="input-field col s9">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="search">
                <label for="nome">Digite o nome do cliente ou o CPF</label>
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
    @if(isset($clientes))
    @if(count($clientes)>0)
    <table class="striped centered responsive-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>Registrado por:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr class="hoverable">
                <td>{{$cliente->nome}}</td>
                <td>{{$cliente->cpf}}</td>
                <td>{{$cliente->email}}</td>
                <td>{{$cliente->cep}}</td>
                <td>{{$cliente->logradouro}}</td>
                <td>{{$cliente->numero}}</td>
                <td>{{$cliente->cidade}}</td>
                <td>{{$cliente->telefone}}</td>
                <td> 
                    @foreach($users as $user)
                        @if($user->id == $cliente->user_id)
                            {{$user->name}}
                        @endif
                    @endforeach
                </td>
                <td><a href="/cliente/edit/{{$cliente->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                <form action="/cliente/delete/{{$cliente->id}}" method="post" name="formValidation">
                    @csrf
                    @method('DELETE')
                    <td><button type="submit" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
                </form>
            </tr>

            @endforeach

        </tbody>
    </table>
    @else
    <h5 class="title center-align">Não há registros ainda com este nome. <a href="/cliente/create">Deseja cadastrar?</a></h5>
    @endif
    @else
    <h5 class="title center-align">Digite algo no campo de busca para procurar. <a href="/cliente/showAll">Buscar por todos os clientes?</a></h5>
    @endif
</div>
@endsection
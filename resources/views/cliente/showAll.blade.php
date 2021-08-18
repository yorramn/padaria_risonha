@extends('layouts.main')
@section('title','Listar todos')
@section('content')
@if(count($clientes) > 0)
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
            @can("update cliente")
            <td><a href="/cliente/edit/{{$cliente->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
            @endcan
            @can("delete cliente")
            <form action="/cliente/delete/{{$cliente->id}}" method="post" name="formValidation">
                @csrf
                @method('DELETE')
                <td><button type="submit" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
            </form>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<h6 class="title right-align"><a href="/cliente/show">Buscando por algum cliente específico?</a></h6>
@else
<h5 class="title center-align">Não há clientes registrados no momento.<a href="/cliente/create"> Deseja cadastrar?</a></h5>
@endif

@endsection
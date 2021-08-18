@extends('layouts.main')
@section('title','Listando promoções')
@section('content')
<div class="section">
    <div class="row">
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
                <h5 class="center-align title">Não há promoções vigentes no momento. Deseja<a href="/promocoes/create">criar?</a></h5>
                @endif
            </tbody>
        </table>
        <br>
        <h6 class="title right-align"><a href="/promocao/show">Buscando por alguma promoção específica?</a></h6>
    </div>
</div>
@endsection
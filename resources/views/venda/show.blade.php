@extends('layouts.main')
@section('title','Buscar venda')
@section('content')
<form action="/venda/show" method="get" class="col s12">
    <h4 class="title center-align">Pesquisar</h4>
    <div class="row">
        <div class="container">
            <div class="input-field col s9">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="search">
                <label for="nome">Digite o código na nota fiscal</label>
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
    @if(isset($vendas))
    <table class="striped centered responsive-table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Desconto</th>
            <th>Total</th>
            <th>Vendido por</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendas as $venda)
        <tr class="hoverable">
            <td>
            @foreach($venda->codigos as $codigo)
                    {{$codigo}}
            @endforeach
            </td>
            <td>
            @foreach($venda->nomes as $nome)
                {{$nome}}
            @endforeach
            </td>
            <td>
            @foreach($venda->quantidade_itens as $quantidade)
                    {{$quantidade}}
            @endforeach
            </td>
            <td>
            @foreach($venda->precos as $preco)
                    {{$preco}}
            @endforeach
            </td>
            @foreach($promocoes as $promocao)
                @if($venda->promocao_id == $promocao->id)
                    @if($promocao->valor > 0)
                        @if($promocao->como_aplicar == "porcentagem")
                            <td>{{$promocao->valor}}%</td>
                        @elseif($promocao->como_aplicar == "valor_bruto")
                            <td>R${{$promocao->valor}}</td>
                        @endif
                    @else
                        <td>Sem desconto</td>
                    @endif
                @endif
            @endforeach
            <td>R${{$venda->total}}</td>
            @foreach($users as $user)
                @if($user->id == $venda->user_id)
                    <td>{{$user->name}}</td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
    @else
        <h5 class="title center-align">Digite algo no campo de busca para procurar.</h5>
    @endif
</div>
@endsection
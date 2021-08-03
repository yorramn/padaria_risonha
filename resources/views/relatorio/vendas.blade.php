<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Produtos</title>
</head>
<body>
<h2 class="center-align">Vendas</h2>
<table class="striped centered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Desconto</th>
            <th>Total</th>
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
            <td>{{$venda->total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<blockquote>
    Emitido por: {{$user->name}}
</blockquote>
</body>
</html>
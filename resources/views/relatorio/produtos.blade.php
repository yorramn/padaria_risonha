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
<h2 class="center-align">Produtos</h2>
<table class="striped centered">
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
        </tr>
        @endforeach
    </tbody>
</table>
<blockquote>
    Emitido por: {{$user->name}}
</blockquote>
</body>
</html>
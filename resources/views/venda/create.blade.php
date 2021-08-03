@extends('layouts.main')
@section('title','Registrar venda')
@section('content')
<div class="section">
    <div class="row">
        <form action="/venda/create" class="col s12" method="POST" name="venda" id="form">
            @csrf
            <div class="input-field col s12 m12 l8 xl8">
                <i class="material-icons prefix">account_circle</i>
                <input id="codigo" type="text" class="validate" name="codigo" id="codigo">
                <label for="codigo">Código</label>
            </div>
            <div class="input-field col s2">
                <i class="material-icons prefix">account_circle</i>
                <input id="quantidade" type="number" class="validate" name="quantidade" id="quantidade">
                <label for="quantidade">Quantidade</label>
            </div>
            <div class="col s2 center">
                <button type="button" id="add" class="btn btn-floating btn-large grey darken-1"><i class="material-icons">add</i></button>
            </div>
            <div class="row">
                <div class="col s12" id="itens">

                </div>
            </div>
            <div class="col s12 m12 l12 xl12 right-align">
                <h5 class="col s9">Total: </h5>
                <h5 class="col s3" id="valor_total"></h5>
                <input type="hidden" name="total" id="total" readonly value="">
            </div>
            <div class="row"></div>
            <div class="row center">
                <div class="input-field col s6 m6 l3 xl3">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="promocao" type="text" class="validate" name="promocao_id">
                    <label for="promocao">Código da Promoção</label>
                </div>
                <div class="input-field col s6 m6 l3 xl3">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="cliente" type="number" class="validate" name="cliente_id">
                    <label for="cliente">CPF do Cliente</label>
                </div>
                <div class="col s12 m12 l6 xl6">
                    <a class="btn  waves-effect red">Cancelar</a>
                    <a class="btn  waves-effect orange lighten-1">Limpar</a>
                    <button type="submit" class="btn  waves-effect green lighten-2">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    let produtos = []
    let itens = document.querySelector("#itens");
    $("#add").click(function() {
        let codigo = $("#codigo").val();
        let quantidade = $("#quantidade").val();
        $.ajax({
            url: "http://127.0.0.1:8000/produto/take/"+codigo,
            type: 'GET',
            dataType: 'json',
            success: function(retorno) {
                for (let index = 0; index < retorno.length; index++) {
                    let produto = exibe(retorno[index].codigo, retorno[index].nome, retorno[index].preco, quantidade);
                    produtos.push(produto);
                    total(produto.preco, produto.quantidade);
                    $("#total").val(valor);
                }
            },
            error: function() {
                alert("error");
            }
        })
    });
    let valor = 0;

    function total(preco, quantidade) {
        valor += preco * quantidade
        $("#valor_total").text(valor);
    }


    function exibe(codigo, nome, preco, quantidade) {
        itens.innerHTML +=
            `                       <p >

                        <div class="row" id="codigo_${codigo}">
                <div class="col s3">
                    <label>
                        <input type="checkbox" name="codigos[]" class="codigo_produto" checked readonly value="${codigo}"/>
                        <span class="title">${codigo}</span>
                    </label>
                </div>
                <div class="col s3">
                    <label>
                        <input type="checkbox" name="nomes[]" value="${nome}"  checked readonly/>
                        <span class="title">${nome}</span>
                    </label>
                </div>
                <div class="col s3">
                    <label>
                        <input type="checkbox" name="precos[]" class="preco" checked value="${preco}"/>
                        <span class="title">${preco}</span>
                    </label>
                </div>
                <div class="col s2 center">
                    <label>
                        <input type="number" class="quantidade" name="quantidade_itens[]" readonly value="${quantidade}">
                    </label>
                </div>
                <div class="col s1 center">
                    <label>
                        <button type="button" onclick="remove(${codigo});" class="btn btn-floating waves wave-effect red"><i class="material-icons">close</i></button>
                    </label>
                </div>
            </div>
                                        
                                    </p>

                                
        `
        let produto = {
            codigo: codigo,
            nome: nome,
            preco: preco,
            quantidade: quantidade
        }
        return produto;
        console.log(produto.codigo)
    }

    function remove(codigo){
        console.log(codigo)
        let produto = produtos.find(i=>i.codigo == codigo)
        for(let i = 0; i < produtos.length; i++){
            if(produtos[i].codigo == produto.codigo){
                produtos.splice(i,1)
                valor = valor - produto.preco;
                $("#total").val(valor);
                $("#valor_total").text(valor);
                document.querySelector(`#codigo_${produto.codigo}`).style.display = "none";
            }
        }
    }
</script>
@endsection
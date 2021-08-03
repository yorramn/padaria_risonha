@extends('layouts.main')
@section('title','Editando cliente '.$cliente->nome)
@section('content')
<div class="section">
    <div class="row">
        <form action="/cliente/update/{{$cliente->id}}" class="col s12" method="PUT">
            @csrf
            @method('PUT')
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="nome" type="text" class="validate" name="nome" value="{{$cliente->nome}}">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="cpf" type="text" class="validate" name="cpf" value="{{$cliente->cpf}}">
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="email" type="email" class="validate" name="email" value="{{$cliente->email}}">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="cep" type="text" class="validate" name="cep" value="{{$cliente->cep}}">
                <label for="cep">CEP</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="logradouro" type="text" class="validate" name="logradouro" value="{{$cliente->logradouro}}">
                <label for="logradouro">Logradouro</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="numero" type="number" class="validate" name="numero" value="{{$cliente->numero}}">
                <label for="numero">Numero</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="cidade" type="text" class="validate" name="cidade" value="{{$cliente->cidade}}">
                <label for="cidade">Cidade</label>
            </div>
            <div class="input-field col s12 m12 l6 xl6">
                <i class="material-icons prefix">account_circle</i>
                <input id="telefone" type="number" class="validate" name="telefone" value="{{$cliente->telefone}}">
                <label for="telefone">Telefone</label>
            </div>
            <div class="col s12 m12 l12 xl12 right-align">
                <a class="btn  waves-effect red">Cancelar</a>
                <a class="btn  waves-effect orange lighten-1">Limpar</a>
                <button type="submit" class="btn  waves-effect green lighten-2">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
<script>
const preencher = (endereco) =>{
    document.querySelector("#logradouro").value = endereco.logradouro;
    document.querySelector("#cidade").value = endereco.localidade;
}
const pesquisarCep = async() =>{
    let cep = document.querySelector("#cep").value;
    let url = "http://viacep.com.br/ws/"+cep+"/json/";
    let dados = await fetch(url);
    let endereco = await dados.json();
    console.log(endereco);
    preencher(endereco);
}
document.querySelector("#cep").addEventListener("focusout",pesquisarCep);
</script>
@endsection
@extends('layouts.main')
@section('title','Adicionar categoria')
@section('content')
<div class="section">
    <div class="row">
        <form action="/categoria/create" method="post" class="col s12">
            @csrf
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" class="validate" name="nome" id="nome">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
                <label for="descricao">Descrição</label>
            </div>
            <div class="col s12 m12 l12 xl12 right-align">
                <a class="btn  waves-effect red">Cancelar</a>
                <a class="btn  waves-effect orange lighten-1">Limpar</a>
                <button type="submit" class="btn  waves-effect green lighten-2">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
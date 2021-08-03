@extends('layouts.main')
@section('title','Editando '.$categoria->nome)
@section('content')
<div class="section">
    <div class="row">
        <form action="/categoria/update/{{$categoria->id}}" method="post" class="col s12">
            @csrf
            @method('PUT')
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" class="validate" name="nome" id="nome" value="{{$categoria->nome}}">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <textarea name="descricao" id="descricao" class="materialize-textarea">{{$categoria->descricao}}</textarea>
                <label for="descricao">Descrição</label>
            </div>
            <div class="col s12 m12 l12 xl12 right-align">
                <a class="btn  waves-effect red">Cancelar</a>
                <a class="btn  waves-effect orange lighten-1">Limpar</a>
                <button type="submit" class="btn  waves-effect green lighten-2">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
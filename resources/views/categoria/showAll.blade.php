@extends('layouts.main')
@section('title','Listando categorias')
@section('content')
<div class="section">
    <div class="row">
        <table class="striped centered responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr class="hoverable">
                    <td>{{$categoria->nome}}</td>
                    <td>{{$categoria->descricao}}</td>
                    @can("update categoria")
                    <td><a href="/categoria/edit/{{$categoria->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                    @endcan
                    @can("delete categoria")
                    <form action="/categoria/delete/{{$categoria->id}}" method="post">
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
        <h6 class="title right-align"><a href="/categoria/show">Buscando por alguma categoria específica?</a></h6>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title','Editando dados de '.$user->name)
@section('content')
<div class="section">
    <div class="row">
        <form action="/user/update/{{$user->id}}" method="post" class="col s12">
            @csrf
            @method('PUT')
            <div class="input-field col s12 m12 l4 xl4">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" class="validate" name="nome" id="nome" value="{{$user->name}}" readonly>
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12 m12 l4 xl4">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" class="validate" name="email" id="email" value="{{$user->email}}" readonly>
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 m12 l4 xl4">
                @if($user->roles->pluck('name')->first() != "")
                <i class="material-icons prefix">account_circle</i>
                <select name="role_name">
                    <option value="" disabled selected>Escolha o cargo</option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option {{$role->name == $user->roles->pluck('name')->first() ? "selected : 'selected'" : ""}} value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                @else
                    <h5 class="center-align"><a href="/categoria/create"><i class="small material-icons">add</i>Adicionar categoria</a></h5>
                @endif
                </select>
                <P class="right-align"><a href="/categoria/create">Não tem a categoria que busca? Adicione uma</a></P>
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
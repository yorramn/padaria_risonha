@extends('layouts.main')
@section('title','Lista de Usuários')
@section('content')
<div class="section">
    @if(isset($users) && count($users)>0)
    <table class="striped centered responsive-table">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>#{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roles->pluck('name')->first()}}</td>
                <td><a href="/user/edit/{{$user->id}}" class="btn btn-floating waves eaves-effect yellow darken-3"><i class="material-icons">edit</i></a></td>
                <form action="/user/delete/{{$user->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <td><button type="submit" class="btn btn-floating waves eaves-effect red darken-2"><i class="material-icons">delete</i></button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
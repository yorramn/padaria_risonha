@extends('layouts.main')
@section('title','Home')
@section('content')
<h3 class="center">Dashboard</h3>
<div class="row">
    <!-- Dashboard de vendas -->
    <div class="col s12 m12 l6 xl6">
        <h5 class="center-align">Gráficos</h5>
    </div>
    <div class="col s12 m12 l6 xl6">
        @if(count($promocoes) > 0)
        @foreach($promocoes as $promocao)
        @foreach($users as $user)
        @if($promocao->user_id == $user->id && $promocao->data_de_validade == date('Y-m-d'))
        <h5 class="center-align">Promoções de hoje</h5>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>{{$promocao->codigo}}</div>
                <div class="collapsible-body"><span>
                        @if($promocao->como_aplicar == "porcentagem")
                        <p>No valor de: {{$promocao->valor}}%</p><br>
                        @else
                        <p>No valor de: R${{$promocao->valor}}</p><br>
                        @endif
                        <p>Descrição: {{$promocao->descricao}}</p><br>
                        <p>Termina em: {{$promocao->data_de_validade}}</p><br>
                        <blockquote>Criada por {{$user->name}}</blockquote>
                    </span></div>
            </li>
        </ul>
        @elseif($promocao->data_de_validade < date('Y-m-d'))
            {{$promocaoController->destroy($promocao->id)}}
        @endif
        @endforeach
        @endforeach
            @if($promocao->data_de_validade > date('Y-m-d'))
            <h5 class="center-align">Próximas promoções</h5>
                @foreach($promocoes as $promocao)
                    @foreach($users as $user)
                    @if($promocao->user_id == $user->id)
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>{{$promocao->codigo}}</div>
                            <div class="collapsible-body"><span>
                                    @if($promocao->como_aplicar == "porcentagem")
                                    <p>No valor de: {{$promocao->valor}}%</p><br>
                                    @else
                                    <p>No valor de: R${{$promocao->valor}}</p><br>
                                    @endif
                                    <p>Descrição: {{$promocao->descricao}}</p><br>
                                    <p>Termina em: {{$promocao->data_de_validade}}</p><br>
                                    <blockquote>Criada por {{$user->name}}</blockquote>
                                </span></div>
                        </li>
                    </ul>
                    @endif
                    @endforeach
                @endforeach
            @endif
        @else
        <p class="right-align">
            <a href=""><i class="material-icons tiny">add</i>Adicionar promoção</a>
        </p>
        @endif
    </div>

</div>
@endsection
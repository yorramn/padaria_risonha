@extends('layouts.main')
@section('title','Home')
@section('content')
<h3 class="center">Dashboard</h3>
<div class="row">
    <!-- Dashboard de vendas 
    <div class="col s12 m12 l6 xl6">
    <div class="row"></div>
        <div class="row center">
            <form action="/venda/create" method="get" name="grafico" class="col s12">
                <div class="input field col s10 m10 l5 xl5">
                    <input id="de" type="date" class="validate" name="de">
                    <label for="de">De</label>
                </div>
                <div class="input field col s10 m10 l5 xl5">
                    <input id="ate" type="date" class="validate" name="ate">
                    <label for="ate">Até</label>
                </div>
                <button type="button" id="show" class="btn s2 m2 l2 xl2 btn-floating waves wave-effect"><i class="material-icons">search</i></button>
            </form>
        </div>
        <div class="row">
        <canvas id="myChart" width="400" height="300"></canvas>
        </div>
    </div>
    -->
    <div class="col s12 m12 l6 xl6">
        @if(isset($promocoes) and count($promocoes) > 0)
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
<script>
/*
        $("#show").click(function() {
        let de = $("#de").val();
        let ate = $("#ate").val();
        $.ajax({
            url: `http://127.0.0.1:8000/venda/take/${de}&${ate}`,
            dataType: 'json',
            success: function(retorno) {
                graph(retorno);
            },
            error: function() {
                alert("error");
            }
        })
    });
    function graph(vendas){
        let data = [];
        let de = $("#de").val();
        let ate = $("#ate").val();
        let vendaDe;
        for (let index = 0; index < vendas.length; index++) {
            let datas = vendas[index].created_at;
            if(de<=datas){
                console.log(datas)
            }
            if(vendas[index].created_at == de){
                console.log(vendas[index].created_at)
            }     
            console.log(vendas.length)

        } 
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {  
    type: 'line',
    data: {
        labels: [de,ate],
        datasets: [{
            label: '# of Votes',
            data: [0,vendas.length],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    }*/
</script>
@endsection
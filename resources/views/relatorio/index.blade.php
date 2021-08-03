@extends('layouts.main')
@section('title','Relatórios')
@section('content')
<div class="section">
    <div class="row">
        <div class="col s12 m6 l6 xl6">
            <h4 class="title center-align">Relatório de Estoque</h4>
            <div class="row">
                <div class="col s9">
                    <h5>Produtos</h5>
                </div>
                <div class="col s3"> <a href="/relatorio/produtos" class="btn-floating btn-large waves-effect waves-light green lighten-2"><i class="material-icons">print</i></a>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6 xl6">
            <h4 class="title center-align">Relatório de Vendas</h4>
            <div class="row">
                <div class="col s9">
                    <h5>Vendas</h5>
                </div>
                <div class="col s3"> <a href="/relatorio/vendas" class="btn-floating btn-large waves-effect waves-light green lighten-2"><i class="material-icons">print</i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>
@php
if($user = auth()->user()){
$team = $user->currentTeam;
$role = $user->teamRole($team);
}


@endphp

<body>
    @role("admin|balconista|estoquista")
    <!-- Dropdown Structure -->
    <ul id='produtos' class='dropdown-content'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create produtos")
        <li><a href="/produto/create">Cadastrar produto</a></li>
        @endcan
        @can("read produtos")
        <li><a href="/produto/showAll">Listar todos</a></li>
        @endcan
        @can("search produtos")
        <li><a href="/produto/show">Pesquisar produto</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='vendas' class='dropdown-content center-align'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create venda")
        <li><a href="/venda/create">Realizar vendas</a></li>
        @endcan
        @can("search venda")
        <li><a href="/venda/show">Consultar venda</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='descontos' class='dropdown-content center-align'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create promocao")
        <li><a href="/promocao/create">Cadastrar promoção</a></li>
        @endcan
        @can("read promocao")
        <li><a href="/promocao/showAll">Listar promoções</a></li>
        @endcan
        @can("search promocao")
        <li><a href="/promocao/show">Consultar promoção</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='categorias' class='dropdown-content center-align'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create categoria")
        <li><a href="/categoria/create">Cadastrar categoria</a></li>
        @endcan
        @can("read categoria")
        <li><a href="/categoria/showAll">Listar todas</a></li>
        @endcan
        @can("search categoria")
        <li><a href="/categoria/show">Consultar categoria</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='encomendas' class='dropdown-content center-align'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create encomenda")
        <li><a href="/encomenda/create">Cadastrar encomenda</a></li>
        @endcan
        @can("search encomenda")
        <li><a href="/encomenda/show">Consultar encomenda</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='clientes' class='dropdown-content center-align'>
        <!--<li class="divider" tabindex="-1"></li>-->
        @can("create cliente")
        <li><a href="/cliente/create">Cadastrar cliente</a></li>
        @endcan
        @can("read cliente")
        <li><a href="/cliente/showAll">Listar todos</a></li>
        @endcan
        @can("search cliente")
        <li><a href="/cliente/show">Consultar cliente</a></li>
        @endcan
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    <ul id='mais' class='dropdown-content center-align'>

        <li class="divider" tabindex="-1"></li>
        <form action="/logout" method="post">
            @csrf
            <li>
                <a href="/logout" onclick="event.preventDefault();
                                        this.closest('form').submit();">Sair</a>
            </li>
        </form>
        <li><i class="close small material-icons center">close</i></li>
    </ul>
    @endrole
    <header>
        <nav class="nav-extended grey darken-3">
            <div class="nav-wrapper container">
                <a href="/" class="brand-logo">Logo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    @auth
                    @role("admin|balconista|estoquista")
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="produtos">
                            Produtos
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="descontos">
                            Promoções
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="categorias">
                            Categorias
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="encomendas">
                            Encomendas
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="clientes">
                            Clientes
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="vendas">
                            Vendas
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    @endrole
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <a href="/logout" onclick="event.preventDefault();
                                        this.closest('form').submit();">Sair</a>

                        </form>
                    </li>
                    @endauth
                    @guest
                    <li>
                        <a href="/login" class="blue-text">
                            Entrar
                        </a>
                    </li>
                    <li>
                        <a href="/register" class="orange-text">
                            Cadastrar
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
            <a href=""></a>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <ul class="collapsible">
                @auth
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Produtos</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create produtos")
                                <li class="collection-item">
                                    <h6><a href="/produto/create">Cadastrar produto</a></h6>
                                </li>
                                @endcan
                                @can("read produtos")
                                <li class="collection-item">
                                    <h6><a href="/produto/showAll">Listar todos</a></h6>
                                </li>
                                @endcan
                                @can("search produtos")
                                <li class="collection-item">
                                    <h6><a href="/produto/show">Pesquisar produto</a></h6>
                                </li>
                            </ul>
                            @endcan
                        </span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Promoções</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create promocao")
                                <li class="collection-item">
                                    <h6><a href="/promocao/create">Cadastrar promoção</a></h6>
                                </li>
                                @endcan
                                @can("read promocao")
                                <li class="collection-item">
                                    <h6><a href="/promocao/showAll">Listar todas</a></h6>
                                </li>
                                @endcan
                                @can("search promocao")
                                <li class="collection-item">
                                    <h6><a href="/promocao/show">Consultar promoção</a></h6>
                                </li>
                                @endcan
                            </ul>
                        </span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Categorias</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create categoria")
                                <li class="collection-item">
                                    <h6><a href="/categoria/create">Cadastrar categoria</a></h6>
                                </li>
                                @endcan
                                @can("read categoria")
                                <li class="collection-item">
                                    <h6><a href="/categoria/showAll">Listar todas</a></h6>
                                </li>
                                @endcan
                                @can("search categoria")
                                <li class="collection-item">
                                    <h6><a href="/categoria/show">Consultar categoria</a></h6>
                                </li>
                                @endcan
                            </ul>
                        </span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Encomenda</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create encomenda")
                                <li class="collection-item">
                                    <h6><a href="/encomenda/create">Cadastrar encomenda</a></h6>
                                </li>
                                @endcan
                                @can("search encomenda")
                                <li class="collection-item">
                                    <h6><a href="/encomenda/show">Consultar encomenda</a></h6>
                                </li>
                                @endcan
                            </ul>
                        </span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Clientes</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create cliente")
                                <li class="collection-item">
                                    <h6><a href="/cliente/create">Cadastrar cliente</a></h6>
                                </li>
                                @endcan
                                @can("read cliente")
                                <li class="collection-item">
                                    <h6><a href="/cliente/showAll">Listar todos</a></h6>
                                </li>
                                @endcan
                                @can("search cliente")
                                <li class="collection-item">
                                    <h6><a href="/cliente/show">Consultar cliente</a></h6>
                                </li>
                                @endcan
                            </ul>
                        </span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
                        <h5>Vendas</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                @can("create venda")
                                <li class="collection-item">
                                    <h6><a href="/venda/create">Realizar venda</a></h6>
                                </li>
                                @endcan
                                @can("search venda")
                                <li class="collection-item">
                                    <h6><a href="/venda/show">Consultar venda</a></h6>
                                </li>
                                @endcan
                            </ul>
                        </span></div>
                </li>
                <div class="divider"></div>
                <li>
                    <div class="collapsible-header "><i class="material-icons">add</i>
                        <h5>Mais</h5>
                    </div>
                    <div class="collapsible-body"><span>
                            <ul class="collection">
                                <li class="collection-item">
                                    <h6><a href="">Emitir relatório</a></h6>
                                </li>
                                <li class="collection-item">
                                    <h6><a href="">Meu perfil</a></h6>
                                </li>
                                <li class="collection-item">
                                    <h6><a href="/dashboard">Dashboard</a></h6>
                                </li>
                                <li class="collection-item">
                                    <h6>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <a href="/logout" onclick="event.preventDefault();
                                        this.closest('form').submit();">Sair</a>
                                        </form>
                                    </h6>
                                </li>
                                @endauth
                                @guest
                                <li>
                                    <a href="/login" class="blue-text">
                                        Entrar
                                    </a>
                                </li>
                                <li>
                                    <a href="/register" class="orange-text">
                                        Cadastrar
                                    </a>
                                </li>
                                @endguest
                            </ul>
                        </span></div>
                </li>
            </ul>
        </ul>

    </header>

    <main class="container">
        @if(session('msg'))
        <input type="hidden" id="msg" value="{{session('msg')}}">
        @endif
        @yield('content')
    </main>

    <footer class="page-footer grey darken-3">
        <div class="container">
            <div class="row center-align yellow-text">
                @auth
                <div class="col s2"><i class="material-icons">person_outline</i></div>
                <div class="col s2">{{$user->name}}</div>
                <div class="col s2"><i class="material-icons">people_outline</i></div>
                <div class="col s2">{{$team->name}}</div>
                <div class="col s2"><i class="material-icons">timer</i></div>
                <div class="col s2" id="timer"></div>
                @endauth
                @guest
                <div class="col s12" id="timer"></div>
                @endguest
            </div>
        </div>
        <div class="footer-copyright grey darken-4">
            <div class="container">
                Gabriel Yorramn © Todos os direitos reservados
                <a class="grey-text text-lighten-4 right" href="#!">Suporte</a>
            </div>
        </div>
    </footer>
    @auth
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a href="/user" class="btn-floating red"><i class="material-icons">person_outline</i></a></li>
            <li><a href="/" class="btn-floating yellow darken-1"><i class="material-icons">home</i></a></li>
            <li><a class="btn-floating green" href="/relatorio/index"><i class="material-icons">print</i></a></li>
            <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
    </div>
    @endauth
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit();
        let msg = document.querySelector("#msg").value;
        M.toast({
            html: msg
        });
        $(document).ready(function() {
            $('.fixed-action-btn').floatingActionButton();
        });
    </script>
    <script>
        hora = () => {
            var dateString = new Date().toLocaleString("pt-BR", {
                timeZone: "America/Sao_Paulo"
            });
            var formattedString = dateString.replace(", ", " - ");
            timer.innerHTML = formattedString;
        }
        setInterval(hora, 1000);
    </script>
</body>

</html>
<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\PromocaoController;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Promocao;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\PdfController;
use Illuminate\Http\Request;
use \Laravel\Jetstream\Role;

#------------------------------Produtos 

Route::get('/', function () {
    $promocoes = Promocao::all();
    $promocaoController = new PromocaoController;
    $users = User::all();
    $user = auth()->user();
    if($user){
        $team = $user->currentTeam;
        $role = $user->teamRole($team);
        return view('index', ["promocoes" => $promocoes,"users" => $users,"promocaoController" => $promocaoController,"user_role"=>$role,"team"=>$team]);
    }
    return view('index', ["promocoes" => $promocoes,"users" => $users,"promocaoController" => $promocaoController]);
});


Route::get('/produto/create', [Produtos::class, 'index'])->middleware('auth');
Route::post('/produto/create', [Produtos::class, 'store'])->middleware('auth');

Route::get('/produto/edit/{id}', [Produtos::class, 'edit'])->middleware('auth');
Route::put('/produto/update/{id}', [Produtos::class, 'update'])->middleware('auth');

Route::delete('produto/delete/{id}', [Produtos::class, 'destroy'])->middleware('auth');

Route::get('/produto/showAll', [Produtos::class, 'showAll'])->middleware('auth');

Route::get('/produto/show', function () {
    $codigo = request('search');
    $categorias = Categoria::all();
    if ($codigo) {
        $produtos = Produto::where([
            ['nome', 'like', '%' . $codigo . '%']
        ])->get();
        return view('produto.search', ["produtos" => $produtos, "categorias" => $categorias]);
    }else {
        return view('produto.search');
    }
});

Route::get('/produto/take/{codigo}',function($codigo){
    $produtos = Produto::where([
        ['codigo', 'like', '%' . $codigo . '%']
    ])->get();
    return json_encode($produtos);
});
#------------------------------------Fim dos produtos



# ---------------------------------- Categorias

Route::get('/categoria/create', [CategoriaController::class, 'index'])->middleware('auth');
Route::post('/categoria/create', [CategoriaController::class, 'store'])->middleware('auth');

Route::get('/categoria/showAll', [CategoriaController::class, 'showAll'])->middleware('auth');

Route::get('/categoria/edit/{id}', [CategoriaController::class, 'edit'])->middleware('auth');
Route::put('/categoria/update/{id}', [CategoriaController::class, 'update'])->middleware('auth');

Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'delete'])->middleware('auth');

Route::get('/categoria/show', function () {
    $search = request('search');
    if ($search) {
        $categorias = Categoria::where([
            ['nome', 'like', '%' . $search . '%']
        ])->get();
        return view('categoria.show', ["categorias" => $categorias]);
    } else {
        return view('categoria.show');
    }
});
#------------------------------------- Fim das categorias

#------------------------------------- Início clientes
Route::get('/cliente/create', [ClienteController::class, 'index'])->middleware('auth');
Route::post('/cliente/create', [ClienteController::class, 'store'])->middleware('auth');

Route::get('/cliente/showAll', [ClienteController::class, 'showAll'])->middleware('auth');

Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->middleware('auth');
Route::get('/cliente/update/{id}', [ClienteController::class, 'update'])->middleware('auth');

Route::delete('/cliente/delete/{id}', [ClienteController::class, 'destroy'])->middleware('auth');

Route::get('/cliente/show', [ClienteController::class, "show"])->middleware('auth');
#--------------------------------------- Fim clientes

#--------------------------------------- Início Promoções
Route::get('/promocao/create', [PromocaoController::class, 'index'])->middleware('auth');
Route::post('/promocao/create', [PromocaoController::class, 'store'])->middleware('auth');

Route::get('/promocao/showAll', [PromocaoController::class, 'showAll']);

Route::get('/promocao/edit/{id}', [PromocaoController::class, 'edit'])->middleware('auth');
Route::put('/promocao/update/{id}', [PromocaoController::class, 'update'])->middleware('auth');

Route::delete('/promocao/delete/{id}', [PromocaoController::class, 'destroy'])->middleware('auth');

Route::get('/promocao/show', [PromocaoController::class, "show"])->middleware('auth');

#--------------------------------------- Fim das Promoções

#--------------------------------------- início das Vendas
Route::get('/venda/create', [VendaController::class, 'index']);
Route::post('/venda/create', [VendaController::class, 'store']);

Route::get('/venda/show',[VendaController::class, 'show']);

Route::get('/venda/showAll',[VendaController::class, 'showAll']);
#--------------------------------------- Fim das Vendas

#--------------------------------------- Início dos relatórios

Route::get('/relatorio/index',[PdfController::class, 'index']);

Route::get('/relatorio/produtos',[PdfController::class, 'produtos']);

Route::get('/relatorio/vendas',[PdfController::class, 'vendas']);
#---------------------------------------Usuários




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

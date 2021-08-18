<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\PromocaoController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\UserController;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Promocao;
use App\Models\User;
use App\Models\Venda;
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
    return view('index', ["promocoes" => $promocoes,"users" => $users,"promocaoController" => $promocaoController]);
});


Route::get('/produto/create', [Produtos::class, 'index'])->middleware('auth')->middleware('permission:create produtos');
Route::post('/produto/create', [Produtos::class, 'store'])->middleware('auth')->middleware('permission:create produtos');

Route::get('/produto/edit/{id}', [Produtos::class, 'edit'])->middleware('auth')->middleware('permission:update produtos');
Route::put('/produto/update/{id}', [Produtos::class, 'update'])->middleware('auth')->middleware('permission:update produtos');

Route::delete('produto/delete/{id}', [Produtos::class, 'destroy'])->middleware('auth')->middleware('permission:delete produtos');

Route::get('/produto/showAll', [Produtos::class, 'showAll'])->middleware('auth')->middleware('permission:read produtos');

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
})->middleware('auth')->middleware('permission:search produtos');

Route::get('/produto/take/{codigo}',function($codigo){
    $produtos = Produto::where([
        ['codigo', 'like', '%' . $codigo . '%']
    ])->get();
    return json_encode($produtos);
});
#------------------------------------Fim dos produtos



# ---------------------------------- Categorias

Route::get('/categoria/create', [CategoriaController::class, 'index'])->middleware('auth')->middleware('permission:create categoria');
Route::post('/categoria/create', [CategoriaController::class, 'store'])->middleware('auth')->middleware('permission:create categoria');

Route::get('/categoria/showAll', [CategoriaController::class, 'showAll'])->middleware('auth')->middleware('permission:read categoria');

Route::get('/categoria/edit/{id}', [CategoriaController::class, 'edit'])->middleware('auth')->middleware('permission:update categoria');
Route::put('/categoria/update/{id}', [CategoriaController::class, 'update'])->middleware('auth')->middleware('permission:update categoria');

Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'delete'])->middleware('auth')->middleware('permission:delete categoria');

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
})->middleware('auth')->middleware('permission:search categoria');;
#------------------------------------- Fim das categorias

#------------------------------------- Início clientes
Route::get('/cliente/create', [ClienteController::class, 'index'])->middleware('auth')->middleware('permission:create cliente');
Route::post('/cliente/create', [ClienteController::class, 'store'])->middleware('auth')->middleware('permission:create cliente');

Route::get('/cliente/showAll', [ClienteController::class, 'showAll'])->middleware('auth')->middleware('permission:read cliente');

Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->middleware('auth')->middleware('permission:update cliente');
Route::get('/cliente/update/{id}', [ClienteController::class, 'update'])->middleware('auth')->middleware('permission:update cliente');

Route::delete('/cliente/delete/{id}', [ClienteController::class, 'destroy'])->middleware('auth')->middleware('permission:delete cliente');

Route::get('/cliente/show', [ClienteController::class, "show"])->middleware('auth')->middleware('permission:search cliente');
#--------------------------------------- Fim clientes

#--------------------------------------- Início Promoções
Route::get('/promocao/create', [PromocaoController::class, 'index'])->middleware('auth')->middleware('permission:create promocao');
Route::post('/promocao/create', [PromocaoController::class, 'store'])->middleware('auth')->middleware('permission:create promocao');

Route::get('/promocao/showAll', [PromocaoController::class, 'showAll'])->middleware('auth')->middleware('permission:read promocao');

Route::get('/promocao/edit/{id}', [PromocaoController::class, 'edit'])->middleware('auth')->middleware('permission:update promocao');
Route::put('/promocao/update/{id}', [PromocaoController::class, 'update'])->middleware('auth')->middleware('permission:update promocao');

Route::delete('/promocao/delete/{id}', [PromocaoController::class, 'destroy'])->middleware('auth')->middleware('permission:delete promocao');

Route::get('/promocao/show', [PromocaoController::class, "show"])->middleware('auth')->middleware('permission:search promocao');

#--------------------------------------- Fim das Promoções

#--------------------------------------- início das Vendas
Route::get('/venda/create', [VendaController::class, 'index'])->middleware('auth')->middleware('permission:create venda');
Route::post('/venda/create', [VendaController::class, 'store'])->middleware('auth')->middleware('permission:create venda');

Route::get('/venda/show',[VendaController::class, 'show'])->middleware('auth')->middleware('permission:search venda');

Route::get('/venda/showAll',[VendaController::class, 'showAll'])->middleware('auth')->middleware('permission:read venda');

Route::get('/venda/take/{de}&{ate}',function($de,$ate){
    //SELECT * FROM risonha.vendas WHERE created_at between created_at AND "2021-08-06 21:00:00";
    //acima, um exemplo
    $vendas = Venda::select("*")->whereBetween('created_at',[$de,$ate])->get();
    return json_encode($vendas);
});
#--------------------------------------- Fim das Vendas

#--------------------------------------- Início das encomendas
Route::get('/encomenda/create', [EncomendaController::class, 'index'])->middleware('auth')->middleware('permission:create encomenda');
Route::post('/encomenda/create', [EncomendaController::class, 'store'])->middleware('auth')->middleware('permission:create encomenda');

Route::get('/encomenda/show', [EncomendaController::class, 'show'])->middleware('auth')->middleware('permission:search encomenda');
#--------------------------------------- Fim das encomendas

#--------------------------------------- Início dos relatórios

Route::get('/relatorio/index',[PdfController::class, 'index']);

Route::get('/relatorio/produtos',[PdfController::class, 'produtos']);

Route::get('/relatorio/vendas',[PdfController::class, 'vendas']);
#---------------------------------------Usuários
Route::get('/user',[UserController::class,'index'])->middleware('auth')->middleware('role:admin');

Route::get('/user/edit/{id}',[UserController::class,'edit'])->middleware('auth')->middleware('role:admin');
Route::put('/user/update/{id}',[UserController::class,'update'])->middleware('auth')->middleware('role:admin');


#---------------------------------------Fim dos usuários

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('index');
})->name('dashboard');

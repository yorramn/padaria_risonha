<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Venda;
use App\Models\Promocao;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function index()
    {
        return view('relatorio.index');
    }

    public function produtos()
    {
        $produtos = Produto::all();
        $categorias = Categoria::all();
        $user = auth()->user();
        $pdf = PDF::loadView('relatorio.produtos',["produtos" => $produtos, "categorias" => $categorias,"user" => $user]);
        return $pdf->stream();
    }
    public function vendas()
    {
        $vendas = Venda::all();
        $user = auth()->user();
        $promocoes = Promocao::all();
        $pdf = PDF::loadView('relatorio.vendas',["vendas" => $vendas,"user" => $user,"promocoes" => $promocoes]);
        return $pdf->stream();
    }
}


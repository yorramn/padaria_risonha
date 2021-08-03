<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
class Produtos extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('produto.create', ["categorias" => $categorias]);
    }

    public function store(Request $request){
        $produto = new Produto;

        $produto->codigo = $request->codigo;
        $produto->nome = $request->nome;
        $produto->data_de_validade = $request->data_de_validade;
        $produto->quantidade = $request->quantidade;
        $produto->tipo_de_quantidade = $request->tipo_de_quantidade;
        $produto->peso = $request->peso;
        $produto->tipo_de_peso = $request->tipo_de_peso;
        $produto->fabricante = $request->fabricante;
        $produto->preco = $request->preco;
        $produto->categoria_id = $request->categoria_id;
        
        $user = auth()->user();
        $produto ->user_id = $user->id;

    

        $produto->save();

        return redirect("/")->with("msg", "Produto cadastrado com sucesso");
    }

    public function edit($id){
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        return view("produto.edit", ['produto' => $produto, 'categorias' => $categorias]);
    }

    public function showAll(){
        $produtos = Produto::all();
        $categorias = Categoria::all();
        return view('produto.show', ['produtos' => $produtos, 'categorias' => $categorias]);
    }

    public function update(Request $request){
        Produto::findOrFail($request->id)->update($request->all());
        return redirect('/produto/showAll')->with("msg", "Produto atualizado com sucesso");
    }

    public function destroy($id){
        Produto::findOrFail($id)->delete();
        return redirect('/produto/showAll')->with("msg", "Produto excluído com sucesso com sucesso");
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\User;
class CategoriaController extends Controller
{
    public function index()
    {
        return view("categoria.create");
    }

    public function store(Request $request)
    {
        $categoria = new Categoria;

        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $user = auth()->user();
        $categoria->user_id = $user->id;
        $categoria->save();



        return redirect("/")->with("msg", "Categoria cadastrada com sucesso!");
    }

    public function showAll()
    {
        $categorias = Categoria::all();

        return view("categoria.showAll", ["categorias" => $categorias]);
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view("categoria.update", ["categoria" => $categoria]);
    }

    public function update(Request $request)
    {
        Categoria::findOrFail($request->id)->update($request->all());

        return redirect("/categoria/showAll")->with("msg", "Categoria atualizada com sucesso");
    }

    public function delete($id)
    {
        Categoria::findOrFail($id)->delete();

        return redirect("/categoria/showAll")->with("msg", "Categoria excluída com sucesso");
    }
}

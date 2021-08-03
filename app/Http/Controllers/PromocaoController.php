<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Promocao;
use App\Models\User;

class PromocaoController extends Controller
{

    public function index(){
        return view('promocao.create');
    }

    public function store(Request $request){
        $user = auth()->user();

        $promocao = new Promocao;
        $promocao->codigo = $request->codigo;
        $promocao->descricao = $request->descricao;
        $promocao->onde_aplicar = $request->onde_aplicar;
        $promocao->como_aplicar = $request->como_aplicar;
        $promocao->valor = $request->valor;
        $promocao->data_de_validade = $request->data_de_validade;
        $promocao->user_id = $user->id;

        $promocao->save();

        return redirect('/')->with("msg", "Promoção cadastrada com sucesso!");
    }

    public function showAll(){
        $users = User::all();
        $promocoes = Promocao::all();

        return view('promocao.showAll',["users" => $users, "promocoes" => $promocoes]);
    }

    public function edit($id){
        $promocao = Promocao::findOrFail($id);

        return view('promocao.edit', ["promocao" => $promocao]);
    }

    public function update(Request $request){
        Promocao::findOrFail($request->id)->update($request->all());

        return redirect('/promocao/showAll')->with("msg","Promoção atualizada com sucesso!");
    }

    public function show(){
        $search = request('search');
        if ($search) {
            $promocoes = Promocao::where([
                ['codigo', 'like', '%' . $search . '%']
            ])->get();
            $users = User::all();
            return view('promocao.show', ["promocoes" => $promocoes, "users" => $users]);
        }else {
            return view('promocao.show');
        }
    }

    public function destroy($id){
        Promocao::findOrFail($id)->delete();

        return redirect('/')->with("msg", "Promoção deletada com sucesso!");

    }


}

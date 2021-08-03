<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class ClienteController extends Controller
{
    public function index(){
        return view('cliente.create');
    }

    public function store(Request $request){
        $cliente = new Cliente;
        $user = auth()->user();

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->cep = $request->cep;
        $cliente->logradouro = $request->logradouro;
        $cliente->numero = $request->numero;
        $cliente->cidade = $request->cidade;
        $cliente->telefone = $request->telefone;
        $cliente->user_id = $user->id;

        $cliente->save();

        return redirect('/')->with("msg", "Cliente registrado com sucesso");
    }

    public function showAll(){
        $clientes = Cliente::all();

        return view('cliente.showAll', ["clientes" => $clientes]);
    }

    public function edit($id){
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', ["cliente" => $cliente]);
    }

    public function update(Request $request){
        Cliente::findOrFail($request->id)->update($request->all());
        return redirect('/cliente/showAll')->with("msg", "Cliente atualizado com sucesso");
    }

    public function destroy($id){
        Cliente::findOrFail($id)->delete();

        return redirect('/cliente/showAll')->with("msg","Cliente deletado com sucesso");
    }

    public function show(){
        $search = request('search');
        if ($search) {
            $clientes = Cliente::where([
                ['cpf', 'like', '%' . $search . '%']
            ])->get();
            $users = User::all();
            return view('cliente.show', ["clientes" => $clientes, "users" => $users]);
        }else {
            return view('cliente.show');
        }
    }
}

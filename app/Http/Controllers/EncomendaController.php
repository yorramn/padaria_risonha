<?php

namespace App\Http\Controllers;
use App\Models\Encomenda;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Produto;
use App\Models\Promocao;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index(){
        $produtos = Produto::all();
        $promocoes = Promocao::all();
        $clientes = Cliente::all();
        return view('encomenda.create',["produtos" => $produtos, "promocoes" => $promocoes, "clientes" => $clientes]);
    }
    public function store(Request $request){
        $encomenda = new Encomenda;

        $user = auth()->user();

        $promocao = Promocao::where("codigo", $request->promocao_id)->first();
        $cliente = Cliente::where("cpf", $request->cliente_id)->first();
        if ($cliente) {
            if ($promocao) {
                $encomenda->codigos = $request->codigos;
                $encomenda->nomes = $request->nomes;
                $encomenda->precos = $request->precos;
                $encomenda->quantidade_itens = $request->quantidade_itens;
                $encomenda->nota_fiscal = rand(000000001, 999999999);
                $encomenda->data_de_pagamento = $request->data_de_pagamento;
                $encomenda->data_de_recebimento = $request->data_de_recebimento;
                if ($promocao->onde_aplicar == "cpf") {
                    $encomendas = Encomenda::all();
                    foreach ($encomendas as $encomenda_src) {
                        if ($encomenda_src->cliente_id == $cliente->id && $encomenda_src->promocao_id == $promocao->id) {
                            return redirect('/encomenda/create')->with("msg", "Promoção não pode ser aplicada ao mesmo CPF");
                        } else if ($encomenda_src->cliente_id == $cliente->id && $encomenda_src->promocao_id != $promocao->id) {
                            if ($promocao->como_aplicar == "valor_bruto") {
                                $encomenda->total = $request->total - $promocao->valor;
                            } else if ($promocao->como_aplicar == "porcentagem") {
                                $encomenda->total = $request->total - ($request->total * ($promocao->valor / 100));
                            }
                            $encomenda->promocao_id = $promocao->id;
                            $encomenda->user_id = $user->id;

                            $encomenda->cliente_id = $cliente->id;

                            for ($i = 0; $i < count($encomenda->codigos) && $i < count($encomenda->codigos); $i++) {
                                VendaController::removerQuantidade($encomenda->codigos[$i], $encomenda->quantidade_itens[$i]);
                            }
                            $encomenda->save();
                            return redirect('/encomenda/create')->with("msg", "Encomenda realizada com sucesso no CPF: " . $cliente->cpf);
                        }
                    }
                } else {
                    if ($promocao->como_aplicar == "valor_bruto") {
                        $encomenda->total = $request->total - $promocao->valor;
                    } else if ($promocao->como_aplicar == "porcentagem") {
                        $encomenda->total = $request->total - ($request->total * ($promocao->valor / 100));
                    }
                    $encomenda->promocao_id = $promocao->id;
                    $encomenda->user_id = $user->id;

                    $encomenda->cliente_id = $cliente->id;

                    for ($i = 0; $i < count($encomenda->codigos) && $i < count($encomenda->codigos); $i++) {
                        VendaController::removerQuantidade($encomenda->codigos[$i], $encomenda->quantidade_itens[$i]);
                    }
                    $encomenda->save();
                    return redirect('/encomenda/create')->with("msg", "Encomenda realizada com sucesso no CPF: " . $cliente->cpf);
                }
            } else {
                return redirect('/promocao/create')->with("msg", "Promoção não cadastrada. Por favor, realize o cadastro nesta tela.");
            }
        } else {
            return redirect('/cliente/create')->with("msg", "Cliente não cadastrado. Por favor, realize o cadastro nesta tela.");
        }
    }
    public function show(){
        $search = request('search');
        if ($search) {
            $encomendas = Encomenda::where([
                ['nota_fiscal', 'like', '%' . $search . '%']
            ])->get();
            $users = User::all();
            $promocoes = Promocao::all();
            return view('encomenda.show', ["vendas" => $encomendas,"users" => $users,"promocoes" => $promocoes]);
        }elseif($search == 0) {
            $encomendas = Encomenda::all();
            $users = User::all();
            $promocoes = Promocao::all();
            return view('encomenda.show', ["encomendas" => $encomendas,"users" => $users,"promocoes" => $promocoes]);
        }else{
            return view('encomenda.show');
        }
    }
}

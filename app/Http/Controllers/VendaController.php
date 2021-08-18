<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Promocao;
use App\Models\Venda;

class VendaController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $promocoes = Promocao::all();
        $clientes = Cliente::all();
        return view('venda.create', ["produtos" => $produtos, "promocoes" => $promocoes, "clientes" => $clientes]);
    }
    public static function removerQuantidade($codigo, $quantidade)
    {
        $produto = Produto::where([
            ["codigo", "like", "%" . $codigo . "%"]
        ])->get()->first();
        $produto->quantidade = $produto->quantidade - $quantidade;
        $produto->save();
    }
    public function store(Request $request)
    {
        $venda = new Venda;

        $user = auth()->user();

        $promocao = Promocao::where("codigo", $request->promocao_id)->first();
        $cliente = Cliente::where("cpf", $request->cliente_id)->first();


        if ($cliente) {
            if ($promocao) {
                $venda->codigos = $request->codigos;
                $venda->nomes = $request->nomes;
                $venda->precos = $request->precos;
                $venda->quantidade_itens = $request->quantidade_itens;
                $venda->nota_fiscal = rand(000000001, 999999999);
                if ($promocao->onde_aplicar == "cpf") {
                    $vendas = Venda::all();
                    if (count($vendas) > 0) {
                        foreach ($vendas as $venda_src) {
                            if ($venda_src->cliente_id == $cliente->id && $venda_src->promocao_id == $promocao->id) {
                                return redirect('/venda/create')->with("msg", "Promoção não pode ser aplicada ao mesmo CPF");
                            } else if ($venda_src->cliente_id == $cliente->id && $venda_src->promocao_id != $promocao->id) {
                                if ($promocao->como_aplicar == "valor_bruto") {
                                    $venda->total = $request->total - $promocao->valor;
                                } else if ($promocao->como_aplicar == "porcentagem") {
                                    $venda->total = $request->total - ($request->total * ($promocao->valor / 100));
                                }
                                $venda->promocao_id = $promocao->id;
                                $venda->user_id = $user->id;
                                $venda->cliente_id = $cliente->id;
                                for ($i = 0; $i < count($venda->codigos) && $i < count($venda->codigos); $i++) {
                                    $this->removerQuantidade($venda->codigos[$i], $venda->quantidade_itens[$i]);
                                }
                                $venda->save();
                                return redirect('/venda/create')->with("msg", "Venda realizada com sucesso no CPF: " . $cliente->cpf);
                            } else if ($venda_src->cliente_id != $cliente->id) {
                                if ($promocao->como_aplicar == "valor_bruto") {
                                    $venda->total = $request->total - $promocao->valor;
                                } else if ($promocao->como_aplicar == "porcentagem") {
                                    $venda->total = $request->total - ($request->total * ($promocao->valor / 100));
                                }
                                $venda->promocao_id = $promocao->id;
                                $venda->user_id = $user->id;
                                $venda->cliente_id = $cliente->id;
                                for ($i = 0; $i < count($venda->codigos) && $i < count($venda->codigos); $i++) {
                                    $this->removerQuantidade($venda->codigos[$i], $venda->quantidade_itens[$i]);
                                }
                                $venda->save();
                                return redirect('/venda/create')->with("msg", "Venda realizada com sucesso no CPF: " . $cliente->cpf);
                            }
                        }
                    } else {
                        if ($promocao->como_aplicar == "valor_bruto") {
                            $venda->total = $request->total - $promocao->valor;
                        } else if ($promocao->como_aplicar == "porcentagem") {
                            $venda->total = $request->total - ($request->total * ($promocao->valor / 100));
                        }
                        $venda->promocao_id = $promocao->id;
                        $venda->user_id = $user->id;
                        $venda->cliente_id = $cliente->id;
                        for ($i = 0; $i < count($venda->codigos) && $i < count($venda->codigos); $i++) {
                            $this->removerQuantidade($venda->codigos[$i], $venda->quantidade_itens[$i]);
                        }
                        $venda->save();
                        return redirect('/venda/create')->with("msg", "Venda realizada com sucesso no CPF: " . $cliente->cpf);
                    }
                } else {
                    if ($promocao->como_aplicar == "valor_bruto") {
                        $venda->total = $request->total - $promocao->valor;
                    } else if ($promocao->como_aplicar == "porcentagem") {
                        $venda->total = $request->total - ($request->total * ($promocao->valor / 100));
                    }
                    $venda->promocao_id = $promocao->id;
                    $venda->user_id = $user->id;
                    $venda->cliente_id = $cliente->id;
                    for ($i = 0; $i < count($venda->codigos) && $i < count($venda->codigos); $i++) {
                        $this->removerQuantidade($venda->codigos[$i], $venda->quantidade_itens[$i]);
                    }
                    $venda->save();
                    return redirect('/venda/create')->with("msg", "Venda realizada com sucesso no CPF: " . $cliente->cpf);
                }
            } else {
                return redirect('/promocao/create')->with("msg", "Promoção não cadastrada. Por favor, realize o cadastro nesta tela.");
            }
        } else {
            return redirect('/cliente/create')->with("msg", "Cliente não cadastrado. Por favor, realize o cadastro nesta tela.");
        }
    }

    public function show()
    {
        $search = request('search');
        if ($search) {
            $vendas = Venda::where([
                ['nota_fiscal', 'like', '%' . $search . '%']
            ])->get();
            $users = User::all();
            $promocoes = Promocao::all();
            return view('venda.show', ["vendas" => $vendas, "users" => $users, "promocoes" => $promocoes]);
        } elseif ($search == 0) {
            $vendas = Venda::all();
            $users = User::all();
            $promocoes = Promocao::all();
            return view('venda.show', ["vendas" => $vendas, "users" => $users, "promocoes" => $promocoes]);
        } else {
            return view('venda.show');
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncomendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json("codigos");
            $table->json("nomes");
            $table->json("precos");
            $table->json("quantidade_itens");
            $table->double("total");
            $table->date("data_de_pagamento");
            $table->date("data_de_recebimento");
            $table->string("nota_fiscal");
            $table->foreignId("user_id")->constrained();
            $table->foreignId("promocao_id")->constrained();
            $table->foreignId("cliente_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encomendas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->bigInteger('livro_codl')->unsigned();  // Chave estrangeira para a tabela 'livro'
            $table->bigInteger('autor_codau')->unsigned(); // Chave estrangeira para a tabela 'autor'

            // Definindo as chaves primárias compostas
            $table->primary(['livro_codl', 'autor_codau']);

            // Adicionando as chaves estrangeiras
            $table->foreign('livro_codl')
                  ->references('codl')->on('livro')
                  ->onDelete('cascade');  // Ação ao excluir o livro (opcional)

            $table->foreign('autor_codau')
                  ->references('codau')->on('autor')
                  ->onDelete('cascade');  // Ação ao excluir o autor (opcional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livro_autor');
    }
};

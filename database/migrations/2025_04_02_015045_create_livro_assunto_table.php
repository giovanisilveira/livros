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
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->bigInteger('livro_codl')->unsigned();  // Chave estrangeira para a tabela 'livro'
            $table->bigInteger('assunto_codas')->unsigned(); // Chave estrangeira para a tabela 'assunto'

            // Definindo as chaves primárias compostas
            $table->primary(['livro_codl', 'assunto_codas']);

            // Adicionando as chaves estrangeiras
            $table->foreign('livro_codl')
                  ->references('codl')->on('livro')
                  ->onDelete('cascade');  // Ação ao excluir o livro (opcional)

            $table->foreign('assunto_codas')
                  ->references('codas')->on('assunto')
                  ->onDelete('cascade');  // Ação ao excluir o assunto (opcional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livro_assunto');
    }
};

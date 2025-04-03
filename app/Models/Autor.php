<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    // Define a tabela associada à model (opcional, pois o Laravel já assume o nome correto)
    protected $table = 'autor';

    // Define a chave primária da tabela (não é mais necessário especificar o auto incremento, o Laravel lida com isso automaticamente)
    protected $primaryKey = 'codau';

    // Define que o campo 'codau' é auto-incrementado
    public $incrementing = true;

    // Indica que a chave primária é do tipo inteiro (opcional, mas pode ser especificado para garantir o tipo correto)
    protected $keyType = 'int';

    // Define os campos que podem ser atribuídos em massa
    protected $fillable = ['nome'];

    // Adiciona proteção contra injeção de dependências nos campos
    protected $guarded = ['codau']; // Protege a chave primária 'codau'

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'autor_codau', 'livro_codl');
    }
}

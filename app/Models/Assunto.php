<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    // Define a tabela associada à model (opcional, o Laravel já assume o nome correto no plural)
    protected $table = 'assunto';

    // Define a chave primária da tabela
    protected $primaryKey = 'codas';

    // Indica que a chave primária é do tipo inteiro
    protected $keyType = 'int';

    // Define que a chave primária não é autoincrementada
    public $incrementing = true;

    // Define os campos que podem ser atribuídos em massa (mass assignment)
    protected $fillable = ['descricao'];

    protected $guarded = ['codas']; // Protege a chave primária 'codas'

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'assunto_codas', 'livro_codl');
    }
}

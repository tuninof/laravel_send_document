<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtor extends Model
{
    // Nome da tabela no banco de dados
    protected $table = 'produtor';

    // Chave primária da tabela
    protected $primaryKey = 'id';

    // Colunas que podem ser preenchidas via Mass Assignment
    protected $fillable = ['nome', 'cpf', 'endereco', 'cidade', 'estado', 'telefone', 'empresa'];

    // Desativa os timestamps automáticos (created_at, updated_at), caso não existam na tabela
    public $timestamps = true;
}

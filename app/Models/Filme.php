<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;
    

    protected $fillable = ['titulo', 'ano', 'id_classificacao', 'id_pais', 'id_plataforma', 'rating', 'link_imdb', 'imagem']; //colunas da tb_filmes

    protected $table = 'tb_filmes'; //tabela tb_filmes
    public $timestamps = false; //nao tenho update at ou created at
    protected $primaryKey = 'id_filme'; //chave primária

    //definir relacionamentos
    public function intervenientes()
    {
        return $this->belongsToMany(Interveniente::class, 'tb_detalhesfilmes', 'id_filme', 'id_interveniente');
    }

    public function userRatings(): HasMany
    {
        return $this->hasMany(UserRating::class, 'id_filme');
    }
}

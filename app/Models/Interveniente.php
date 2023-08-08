<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interveniente extends Model
{
    use HasFactory;

    protected $table = 'tb_intervenientes'; //nome da tabela dos intervenientes no mysql

    protected $primaryKey = 'id_interveniente'; //chave primária

    protected $fillable = ['interveniente', 'id_pais']; 

    //relacionamento com o modelo Filme (muitos para muitos)  
    public function filmes()
    {
        return $this->belongsToMany(Filme::class, 'tb_detalhesfilmes', 'id_interveniente', 'id_filme');
    }
}

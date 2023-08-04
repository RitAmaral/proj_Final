<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;
    

    protected $fillable = ['titulo', 'ano', 'id_classificacao', 'id_pais', 'id_plataforma', 'rating', 'link_imdb', 'imagem'];

    protected $table = 'tb_filmes';
    public $timestamps = false;
    protected $primaryKey = 'id_filme';

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

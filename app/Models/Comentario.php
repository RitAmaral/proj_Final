<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; //importar modelo do User e Filme
use App\Models\Filme;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'tb_comentarios';
    protected $primaryKey = 'id_comentarios';
    public $timestamps = false;

    protected $fillable = ['comentario', 'id', 'id_filme'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function filme()
    {
        return $this->belongsTo(Filme::class, 'id_filme', 'id_filme');
    }
}

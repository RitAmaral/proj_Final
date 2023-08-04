<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filme;
use App\Models\User;

class UserRating extends Model
{
    use HasFactory;

    protected $table = 'tb_users_rating';
    protected $primaryKey = 'id_ur';
    public $timestamps = false;

    //definir a relação com modelo Filme
    public function filme()
    {
        return $this->belongsTo(Filme::class, 'id_filme', 'id_filme');
    }

    //definir a relação com modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}

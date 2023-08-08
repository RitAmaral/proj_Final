<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervPreferido extends Model
{
    use HasFactory;

    protected $table = 'tb_interv_preferidos'; //tabela dos intervenientes preferidos, contem o id do user e o id do interveniente
    protected $fillable = ['id', 'id_interveniente']; //id é o id do user

    public $timestamps = false;
}

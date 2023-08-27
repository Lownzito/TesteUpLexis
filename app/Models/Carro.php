<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome_veiculo',
        'link',
        'ano',
        'combustivel',
        'portas',
        'quilometragem',
        'cambio',
        'cor',
        'photo_url',
        'preco'
    ];
}

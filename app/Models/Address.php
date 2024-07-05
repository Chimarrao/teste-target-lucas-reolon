<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'logradouro', 'numero', 'bairro', 'complemento', 'cep'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
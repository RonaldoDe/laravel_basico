<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{

    protected $primaryKey = 'id_carro';
    protected $fillable = [
        'serie', 'marca', 'id_propietario'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

   
}

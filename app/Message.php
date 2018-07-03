<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    // protected $table = 'nombre_de_mi_tabla';

    protected $fillable = ['nombre', 'email', 'mensaje'];


    public function user()
    {

    	return $this->belongsTo(User::class);

    }

}

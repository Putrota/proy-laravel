<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

	protected $fillable = ['body'];


	public function message()
	{

		return $this->belongsTo(Message::class);

	}


}

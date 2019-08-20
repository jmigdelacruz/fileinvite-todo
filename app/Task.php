<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	//makes these columns mass assignable
	protected $fillable = [
	    'text',
	    'finished',
	];

	//cast boolean to finished column
	protected $casts = [
	    'finished' => 'boolean',
	];
}

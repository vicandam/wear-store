<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $table = 'dealers';

    protected $fillable = ['user_id', 'group', 'recruiter', 'contact_number', 'address', 'credit_limit'];

    function user()
    { 
	   return $this->belongsTo(User::class);
	}
}








<?php

namespace Modules\Client\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'name',
    	'email',
    	'mobile',
    	'address',
    	'mobile',
    	'expire_on',
        'password',
    	'status',
        'slag'
    ];

    protected $hidden = [
    	
    ];
}

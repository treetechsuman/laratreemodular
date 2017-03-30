<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table='users';
    protected $fillable = ['name', 'email','client_id','user_type', 'password',];
    protected $hidden = [
         'remember_token',
    ];
}

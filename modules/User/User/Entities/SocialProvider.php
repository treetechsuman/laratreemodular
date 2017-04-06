<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
	
	protected $table='socialproviders';
    protected $fillable = ['user_id', 'provider_id', 'provider'];
    
}

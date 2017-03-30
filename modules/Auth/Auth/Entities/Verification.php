<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
	protected $table='verifications';
    protected $fillable = ['user_id', 'verification_code', 'status'];   
}
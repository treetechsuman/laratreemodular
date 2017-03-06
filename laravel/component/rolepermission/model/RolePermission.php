<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	protected $table = 'role_permissions';
    protected $fillable =[
    	'role_id',
    	'permission_id'
    ];
}
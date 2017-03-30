<?php 
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model{
	protected $table='role_permissions';
	protected $fillable=[
				'id',
				'role_id',
				'permission_id',
			];
	protected $hidden=[
	];
}
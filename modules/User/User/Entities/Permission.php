<?php 
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model{
	protected $table='permissions';
	protected $fillable=[
				'id',
				'name',
			];
	protected $hidden=[
	];
}
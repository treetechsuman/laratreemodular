<?php 
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
	protected $table='users';
	protected $fillable=[
				'id',
				'name',
				'email',
				'contact_no',
				'gender',
				'address',
				'password',
				'status',
				'userimage_name',
				'ip_address',
				'browser_agent',
				'remember_token',
			];
	protected $hidden=[
	];
}
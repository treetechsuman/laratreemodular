<?php 
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
	protected $table='users';
	protected $fillable=[
				'name', 'email', 'password',
			];
	protected $hidden=[
		'password', 'remember_token',
	];
}
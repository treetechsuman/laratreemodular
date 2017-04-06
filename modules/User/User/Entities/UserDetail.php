<?php 
namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model{
	protected $table='user_details';
	protected $fillable=[
				'id',
				'mobile',
				'gender',
				'dob',
				'address',
				'image',
				'status',
				'type',
				'user_id',
			];
	protected $hidden=[
	];
}
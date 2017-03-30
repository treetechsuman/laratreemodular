<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model{
	protected $table='units';
	protected $fillable=[
				'id',
				'name',
				'display_order',
				'status',
			];
	protected $hidden=[
	];
}
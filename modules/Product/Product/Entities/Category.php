<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
	protected $table='categories';
	protected $fillable=[
				'id',
				'name',
				'parent_id',
				'display_order',
				'image',
				'status',
			];
	protected $hidden=[
	];
}
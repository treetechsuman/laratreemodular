<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
	protected $table='products';
	protected $fillable=[
				'id',
				'name',
				'category_id',
			];
	protected $hidden=[
	];
}
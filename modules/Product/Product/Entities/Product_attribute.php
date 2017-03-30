<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model{
	protected $table='product_attributes';
	protected $fillable=[
				'id',
				'name',
				'product_id',
			];
	protected $hidden=[
	];
}
<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_attribute_value extends Model{
	protected $table='product_attribute_values';
	protected $fillable=[
				'id',
				'value',
				'product_attribute_id',
			];
	protected $hidden=[
	];
}
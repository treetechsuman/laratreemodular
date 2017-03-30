<?php 
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model{
	protected $table='product_images';
	protected $fillable=[
				'id',
				'name',
				'caption',
				'product_id',
			];
	protected $hidden=[
	];
}
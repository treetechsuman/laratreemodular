<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeValuesTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('product_attribute_values', function (Blueprint $table) {
			$table->increments('id');
			$table->string('value');
			$table->integer('product_attribute_id')->unsigned();
			$table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
			$table->timestamps();
		});
	}
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('product_attribute_values');
	}
}
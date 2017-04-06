<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('user_details', function (Blueprint $table) {
			$table->increments('id');
			$table->string('mobile');
			$table->enum('gender',['Male','Female','Other']);
			$table->string('dob');
			$table->string('address');
			$table->string('image');
			$table->enum('status',['Active','Inactive']);
			$table->enum('type',['front','back']);
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('user_details');
	}
}
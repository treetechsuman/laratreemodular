<?php 
namespace Modules\Mytest\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class SumanDataSeeders extends Seeder{

	public function run(){

		Model::unguard();

		for($i=1;$i<=20;$i++){
			$SumanData = [

					'name'=>$faker->name(),
					'email'=>$faker->email(),
					'status'=>$faker->status(),

			];
		}

		//$this->call(OthersTableSeeder::class);
	}
}

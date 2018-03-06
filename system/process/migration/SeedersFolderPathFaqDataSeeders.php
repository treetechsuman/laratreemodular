<?php 
namespace Modules\Faq\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

use Modules\Faq\Repositories\FaqModuleRepository;

class FaqDataSeeders extends Seeder{

	private $FaqModuleRepo;

	public function __construct(FaqModuleRepository $FaqModuleRepo){

		$this->FaqModuleRepo = $FaqModuleRepo;

	}

	public function run(){

		Model::unguard();

		$faker = Faker::create();

		for($i=1;$i<=20;$i++){
			$faqData = [

					'question'=>$faker->question(),
					'ans'=>$faker->ans(),
					'display_order'=>$faker->display_order(),
					'status'=>$faker->status(),

			];
			$this->FaqModuleRepo->createFaq($faqData);

			echo '.';
		}

		//$this->call(OthersTableSeeder::class);
	}
}

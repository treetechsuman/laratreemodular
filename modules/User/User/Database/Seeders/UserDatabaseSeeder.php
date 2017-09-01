<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Config;
use DB;
class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Config::get('user.roles');
        Model::unguard();
        $checkSuperAdmin=DB::table('users')->where('email','me.suman11@gmail.com')->get();
        if(count($checkSuperAdmin)<=0){
            DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'me.suman11@gmail.com',
                'password' => bcrypt('123456'),
            ]);

            foreach($roles as $role){
                DB::table('roles')->insert([
                    'name' => $role,
                ]);
            }
            DB::table('user_roles')->insert([
                'user_id'=>1,
                'role_id'=>1
            ]);
        }

        $faker = Faker::create();
        //$candidates = Candidate::lists('id');
        foreach(range(1, 5) as $index)
        {
            DB::table('users')->insert([
                'name'=>$faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('123456')
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}

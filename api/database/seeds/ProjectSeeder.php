<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();

        for ($x = 0; $x <= 10; $x++) {
            DB::table('projects')->insert([
                'name' => $faker->company,
            	'user_id' => 1,
            	'address_id' => rand(1,10),
                'safety_plan' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'status' => $faker->randomElement($array = array ('open','closed'))
            ]);
        }
    }
}

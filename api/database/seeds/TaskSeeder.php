<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class TaskSeeder extends Seeder
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
            DB::table('tasks')->insert([
            	'project_id' => rand(1,10),
                'title' => $faker->catchPhrase,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'start_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
                'end_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
                'status' => $faker->randomElement($array = array ('open','closed'))
            ]);
        }
    }
}

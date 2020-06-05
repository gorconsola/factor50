<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $additions = [null, 'a', 'hs', '3'];

        for ($i=0; $i < 10; $i++) {

            $faker = Faker::create();

            DB::table('addresses')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'street' => $faker->streetName,
                'house_number' => rand(1, 120),
                'house_number_addition' => $additions[rand(0,3)],
                'postal_code' => '1018 LV',
                'city' => $faker->city,
                'country' => 'NL',
                'updated_at' => '2019-10-01 10:01:00',
                'created_at' => '2019-10-01 10:01:00'
            ]);

        }
    }
}

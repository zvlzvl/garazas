<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker = (new \Faker\Factory())::create();
$faker->addProvider(new \Faker\Provider\Fakecar($faker));

        DB::table('users')->insert([
            'name' => 'Garazas',
            'email' => 'garazas@gmail.com',
            'password' => Hash::make('123'),
        ]);

        foreach(range(1, 20) as $run) {
        DB::table('mechanics')->insert([
            'name' => $faker->firstName,
            'surname' => $faker->lastName,
        ]);
    }

    $makers = ['HONDA', 'RAM', 'FORD', 'GMC', 'TOYOTA', 'NISSAN'];
    $damages = ['Left side', 'Right side', 'window', 'electronic'];

    foreach(range(1, 50) as $run) {
    DB::table('trucks')->insert([
        'maker' => $makers[rand(0, count($makers)-1)],
        'plate' =>  $faker->vehicleRegistration,
        'make_year' => $faker->biasedNumberBetween(1998,2021, 'sqrt'),
        'mechanic_notices' => $damages[rand(0, count($damages)-1)],
        'mechanic_id' => rand(1, 20),
    ]);
}

        
    }


}


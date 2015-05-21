<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TeacherTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Teacher::create([
              'teano'   => $faker->name,
              'teachername'    => $faker->name,
              'classname'    => $$faker->name,
              'schoolname'    => $faker->name
			]);
		}
	}

}
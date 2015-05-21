<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StudentTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Student::create([
              'stuno'   => $faker->name,
              'stuname'    => $faker->name,
              'classname'    => $faker->name,
              'schoolname'    => $faker->name
			]);
		}
	}

}
<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\DB::table('news')->insert($this->getData());
    }

	public function getData(): array
	{
		$faker = Factory::create();
		$data = [];
		for($i=0; $i < 10; $i++) {
			$data[] = [
				'category_id' => 1,
				'title' => $faker->sentence(mt_rand(3,10)),
				'author' => $faker->userName(),
				'description' => $faker->text(mt_rand(100,200))
			];
		}

		return $data;
	}
}

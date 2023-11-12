<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;

class CustomSeederCommand extends Command
{
    protected $signature = 'db:seed-custom';

    protected $description = 'Seed the database with 1k categories and 1M products';

    protected $faker;

    public function __construct(Faker $faker)
    {
        parent::__construct();
        $this->faker = $faker;
    }

    public function handle()
    {
        $this->seedCategories();
        $this->seedProducts();
    }

    private function seedCategories()
    {
        for ($i = 0; $i < 1000; $i++) {
            $name = $this->faker->unique()->name;
            $description = $this->faker->text;

            \App\Models\Category::create([
                'name' => $name,
                'description' => $description,
            ]);
        }
    }

    private function seedProducts()
    {
        for ($i = 0; $i < 1000000; $i++) {
            $name = $this->faker->unique()->name;
            $description = $this->faker->text;
            $price = $this->faker->randomFloat(2, 0, 1000);
            $categoryId = rand(1, 1000);

            \App\Models\Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_id' => $categoryId,
            ]);
        }
    }
}

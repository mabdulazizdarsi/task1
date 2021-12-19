<?php

namespace Database\Seeders;

use App\Models\brand;

use App\Models\models;
use App\Models\stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        brand::factory(5)->create();
        models::factory(100)->create();
        stock::factory(10000)->create();
    }
}

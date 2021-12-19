<?php

namespace Database\Seeders;

use App\Models\models;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        models::factory()->times(300);
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        stock::factory()->times(5000);
        
    }
}

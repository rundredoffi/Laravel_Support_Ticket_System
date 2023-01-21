<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
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
        Label::factory(5)->create();
        Category::factory(5)->create();
        Priority::factory(3)->create();

        $this->call([
            UserSeeder::class,
            TicketSeeder::class,
        ]);
    }
}

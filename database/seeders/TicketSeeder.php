<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory(45)->create()->each(function ($ticket) {
            $ticket->labels()->attach(Label::all()->random(3) ?? Label::factory()->create(3));
            $ticket->categories()->attach(Category::all()->random(3) ?? Category::factory()->create(3));
        });
    }
}

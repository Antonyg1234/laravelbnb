<?php

use Illuminate\Database\Seeder;
use App\Models\Bookable;

class BookableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bookable::class,100)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert(['name' => 'new']);
        DB::table('order_statuses')->insert(['name' => 'complete']);
        DB::table('order_statuses')->insert(['name' => 'cancel']);
    }
}

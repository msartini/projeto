<?php

use Illuminate\Database\Seeder;

class OrdersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                ['doc_number'=>2001, 'product_id' => 4, "user_id" => 1, 'quantity' => 9],
                ['doc_number'=>2001, 'product_id' => 5, "user_id" => 1, 'quantity' => 1],
                ['doc_number'=>5000, 'product_id' => 4, "user_id" => 1, 'quantity' => 10],
                ['doc_number'=>5000, 'product_id' => 7, "user_id" => 1, 'quantity' => 12],
            ];
        DB::table('orders')->insert($data);
    }
}

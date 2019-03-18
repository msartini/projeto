<?php

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
        $this->call(UsersTableSeed::class);
        $this->call(CategoriesTableSeed::class);
        $this->call(ProductsTableSeed::class);
        $this->call(OrdersTableSeed::class);
    }
}

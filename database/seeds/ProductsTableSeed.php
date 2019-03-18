<?php

use Illuminate\Database\Seeder;

class ProductsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                ['name'=>'Video game', 'stock' => 200, "category_id" => 1],
                ['name'=>'Toalha', 'stock' => 1000, "category_id" => 2],
                ['name'=>'Lençol', 'stock' => 700, "category_id" => 2],
                ['name'=>'Computador HP', 'stock' => 500, "category_id" => 3],
                ['name'=>'Computador Dell', 'stock' => 200, "category_id" => 3],
                ['name'=>'Quebra cabeça', 'stock' => 1000, "category_id" => 4],
                ['name'=>'Vídeo Game', 'stock' => 600, "category_id" => 5],
                ['name'=>'Vasos', 'stock' => 1000, "category_id" => 6],
                ['name'=>'Camisa Regata', 'stock' => 2000, "category_id" => 7],
                ['name'=>'Blusa Tam:P', 'stock' => 2000, "category_id" => 7],
                ['name'=>'Tela de pintura', 'stock' => 1000, "category_id" => 8],
                ['name'=>'Tinta aquarela', 'stock' => 1000, "category_id" => 8],
            ];
        DB::table('products')->insert($data);
    }
}

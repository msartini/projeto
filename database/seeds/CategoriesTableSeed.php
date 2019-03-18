<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                ['name'=>'Eletrônicos'],
                ['name'=>'Cama mesa e banho'],
                ['name'=>'Computadores'],
                ['name'=>'Brinquedos'],
                ['name'=>'Games'],
                ['name'=>'Jardinagem'],
                ['name'=>'Moda'],
                ['name'=>'Artesanato'],
            ];
        DB::table('categories')->insert($data);
    }
}

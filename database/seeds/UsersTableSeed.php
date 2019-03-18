<?php

use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                ['name'=>'Marcio Sartini', 'email' => "msartini@gmail.com", "password" => "12345"],
            ];
        DB::table('users')->insert($data);
    }
}

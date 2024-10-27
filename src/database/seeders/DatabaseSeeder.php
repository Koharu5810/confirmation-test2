<?php

namespace Database\Seeders;

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
        $this->call([
            SeasonsTableSeeder::class,  // 先にseasonsをシードする（季節情報をproductsに含めるため）
            ProductsTableSeeder::class,
        ]);
    }
}

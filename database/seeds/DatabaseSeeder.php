<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AreasTableSeeder::class,
            RestaurantsTableSeeder::class,
            MenuItemsTableSeeder::class,
            OrdersTableSeeder::class,
            CartsTableSeeder::class
        ]);
    }
}

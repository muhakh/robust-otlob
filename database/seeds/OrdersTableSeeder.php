<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Order::class, 50)->create();
        $menu_items = App\MenuItem::all();

        App\Order::all()->each(function ($order) use ($menu_items) {
            $order->menu_items()->attach(
                $menu_items->random(rand(1, 3))->pluck('id')->toArray(),
                ['quantity'=>rand(5, 15)]
            );
        });
    }
}

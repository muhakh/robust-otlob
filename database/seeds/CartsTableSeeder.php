<?php

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cart::class, 50)->create();
        $menu_items = App\MenuItem::all();

        App\Cart::all()->each(function ($cart) use ($menu_items) {
            $cart->menu_items()->attach(
                $menu_items->random(rand(1, 3))->pluck('id')->toArray(),
                ['quantity'=>rand(5, 15)]
            );
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Restaurant::class, 50)
            ->create()
            ->each(function ($restaurant) {
                $restaurant->menu_items()->save(factory(App\MenuItem::class)->make());
                });
        $areas = App\Area::all();

        App\Restaurant::all()->each(function ($restaurant) use ($areas) {
            $restaurant->areas()->attach(
                $areas->random()->pluck('id')->toArray()
            );
        });
    }
}

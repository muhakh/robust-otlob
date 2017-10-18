<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_menu_items', function (Blueprint $table) {
            $table->integer('cart_id')->unsigned()->nullable();
            $table->foreign('cart_id')->references('id')
                  ->on('carts')->onDelete('cascade');

            $table->integer('menu_item_id')->unsigned()->nullable();
            $table->foreign('menu_item_id')->references('id')
                   ->on('menu_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_menu_items');
    }
}

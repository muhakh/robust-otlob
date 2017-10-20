<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'shipping_address'];
    /**
     * The menu items that belong to the order.
     */
    public function menu_items()
    {
        return $this->belongsToMany('App\MenuItem', 'order_menu_items', 'order_id', 'menu_item_id')
                    ->select(['id', 'price', 'quantity', 'restaurant_id'])
                    ->withTimestamps();
    }

    /**
     * The user that the cart belongs to.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}

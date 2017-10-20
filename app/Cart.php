<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id'];
    /**
     * The menu items that belong to the cart.
     */
    public function menu_items()
    {
        return $this->belongsToMany('App\MenuItem', 'cart_menu_items', 'cart_id', 'menu_item_id')
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

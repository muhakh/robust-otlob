<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'manager_id'];

    /**
     * Get the menu items for the Restaurant.
     */
    public function menu_items()
    {
        return $this->hasMany('App\MenuItem');
    }

    /**
     * The user that the cart belongs to.
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'manager_id');
    }

    /**
     * The areas that belong to the restaurant.
     */
    public function areas()
    {
        return $this->belongsToMany('App\Area', 'restaurant_areas', 'area_id', 'restaurant_id')
                    ->withTimestamps();
    }
}

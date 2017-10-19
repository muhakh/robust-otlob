<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['title', 'description', 'price', 'restaurant_id'];

    /**
     * Get the Restaurant that the Menu Item belongs to.
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}

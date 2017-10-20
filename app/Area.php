<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name', 'city'];

    /**
     * The restaurants that belong to the area.
     */
    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant', 'restaurant_areas', 'restaurant_id', 'area_id')
                    ->withTimestamps();
    }
}

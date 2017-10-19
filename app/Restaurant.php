<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'manager_id'];

    /**
     * Get the menu items for the blog post.
     */
    public function menu_items()
    {
        return $this->hasMany('App\MenuItem');
    }
}

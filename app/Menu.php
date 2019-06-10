<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'slug'
    ];

    public function items() {
        return $this->hasMany(MenuItem::class)->ordered();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

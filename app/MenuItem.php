<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MenuItem extends Model
{
    protected $fillable = ['route_name', 'route_parameter', 'label', 'href', 'menu_id', 'parent_id'];

    public function submenu()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
                    ->ordered();
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id')
                    ->ordered();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function scopeOrdered(Builder $query)
    {
        return $query->orderBy('position')
                     ->orderBy('created_at');
    }
}

<?php
namespace App\Modules\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'slug'];
	protected $fillable = ['parent_id', 'position', 'active'];

    public function products(){

        return $this->belongsToMany('App\Modules\Catalog\Product','product_categories','category_id','product_id');
    }

    public function subcategories(){

        return $this->hasMany('App\Modules\Catalog\Category','parent_id');
    }
}

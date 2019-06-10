<?php
namespace App\Modules\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'slug'];

}
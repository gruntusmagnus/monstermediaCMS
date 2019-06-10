<?php
namespace App\Modules\Catalog;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'slug'];

}
<?php
namespace App\Modules\Catalog;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'slug'];
    protected $fillable = ['code', 'ean', 'quantity', 'price', 'vat_id', 'active'];

    protected $casts = ['active' => 'boolean'];


    public function categories(){

        return $this->belongsToMany('App\Modules\Catalog\Category','product_categories','product_id','category_id');
    }


    public function coverImage(){
        //todo marek - vrátí výchozí obrázek;
    }

    public function images(){
        //todo marek - vrátí všechny obrázky;
    }

    public function files(){
        return $this->morphMany('App\File','fileable');
    }

    public function getFiles(){
        if($file = $this->files()){
            return storage_path(strtolower(class_basename($this)).'/'.$file->fileable_id);
        }
        return null;
    }

    public function vat(){
        return $this->belongsTo('App\Modules\Catalog\Vat');
    }
    public function getPrice(){
        return $this->price*(($this->vat->percentage + 100) / 100);
	}
}

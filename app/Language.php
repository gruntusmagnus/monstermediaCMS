<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->hasMany(User::class,'language_id','id');
    }
}

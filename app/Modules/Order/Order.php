<?php
namespace App\Modules\Order;

use App\Modules\Catalog\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        //todo:: po přidělání platebních modulů
        return "payment_name";
        //return $this->belongsTo('App\Modules\Payment');
    }

    public function detail(){
        return $this->products()->join('order_states','order_state_id','=','order_states.id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_products','product_id','order_id')->withPivot(['order_state_id','quantity,unit_price','unit_tax'])->withTimestamps();
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

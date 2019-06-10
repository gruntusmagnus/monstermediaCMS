<?php

namespace App;

use App\Modules\Order\Order;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'sex',
        'last_online',
        'company_id',
        'vat_number',
        'vat_number_2',
        'date_birth',
        'last_online',
        'language_id',
        'customer_group_id',
        'points',
        'gdpr',
        'note',
        'hash'
    ];
    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'last_online',
        'hash'
    ];

    public function chat(){
        return $this->hasOne(Modules\Chat\Chat::class, 'customer_id');
    }


    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function auth() {
        return $this->morphOne(Authenticable::class, 'authenticable');
    }
}

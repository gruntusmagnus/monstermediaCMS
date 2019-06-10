<?php

namespace App\Modules\Chat;

use App\Modules\Chat\Events\ChatActivated;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $fillable = ['is_active'];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $dispatchesEvents = [
        'created' => ChatActivated::class,
        'updated' => ChatActivated::class
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function customer() {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
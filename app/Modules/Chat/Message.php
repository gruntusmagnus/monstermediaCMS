<?php

namespace App\Modules\Chat;

use App\Employee;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['customer_id', 'employee_id', 'chat_id', 'content'];

    public function customer() {
        return $this->belongsTo(User::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
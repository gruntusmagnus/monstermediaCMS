<?php

namespace App;

use App\Notifications\Admin\MailResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticable
{
    use Notifiable, CanResetPassword;
    protected $guard = 'employee';
    protected $fillable = [
        'firstname',
        'lastname',
        'employee_group_id',
        'email',
    ];

    /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function language()
    {
        $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function auth() {
        return $this->morphOne(Authenticable::class, 'authenticable');
    }
}

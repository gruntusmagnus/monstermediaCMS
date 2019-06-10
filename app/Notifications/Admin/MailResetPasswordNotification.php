<?php

namespace App\Notifications\Admin;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $link = url( "/admin/reset-password/".$this->token );
        return ( new MailMessage )
            ->subject( 'Zapomenuté heslo' )
            ->line( "Dobrý den! Někdo, pravděpodobně vy, požádal o změnu hesla na serveru ".config('app.name').'.' )
            ->action( 'Nastavit nové heslo', $link )
            ->line( "Tento odkaz vyprší za ".config('auth.passwords.employees.expire')." minut" )
            ->line( "V případě, že jste o nové heslo nežádali, s klidem tento e-mail ignorujte." );    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

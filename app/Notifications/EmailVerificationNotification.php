<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class EmailVerificationNotification extends VerifyEmail
{
    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
        ->subject(__('Vérifiez votre compte') . ' - ' . config('app.name', 'TrackIT Support System'))
        ->line(__('Afin de profiter pleinement de notre plateforme, veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.'))
        ->action(__('Vérifier l\'adresse e-mail'), $url)
        ->line(__('Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.'));
    }
}

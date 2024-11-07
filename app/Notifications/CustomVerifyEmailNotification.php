<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends Notification
{
    protected $guard;
    public function __construct($guard)
    {
        $this->guard = $guard;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        $subject = $this->getDynamicSubject();
        $verificationUrl = URL::temporarySignedRoute(
            'verification.customVerify',
            now()->addMinutes(60),
            ['id' => $notifiable->getKey()]
        );
        return (new MailMessage)
        ->subject($subject)
        ->markdown('emails.custom_verify_email', ['verificationUrl' => $verificationUrl]);
    }
    protected function getDynamicSubject()
    {
        $subjects = [
            'web' => 'Customer Email Verification',
            'contractor' => 'Contractor Email Verification',
        ];
        return $subjects[$this->guard] ?? 'Email Verification';
    }
}

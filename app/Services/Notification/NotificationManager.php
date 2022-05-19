<?php

namespace App\Services\Notification;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class NotificationManager
{
    /** @var Mailable */
    protected $mailable;

    /**
     * @param Mailable $mailContract
     * @return $this
     */
    public function setMailAble(Mailable $mailable)
    {
        $this->mailable = $mailable;
        return $this;
    }

    /**
     * @param string $toEmail
     * @return mixed|void
     */
    public function send(string $toEmail)
    {
        Mail::to($toEmail)->send($this->mailable);
    }
}

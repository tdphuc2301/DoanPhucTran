<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data ;
    protected $type ;
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }
       
    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type) :self{
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $data
     * @return void
     */
    public function setData(array $data) :self{
        $this->data = $data;
        return $this;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = config("mail-template.$this->type.template");
        return $this->view($template)
        ->subject('Đơn hàng mới!')
        ->with($this->data);
    }
}

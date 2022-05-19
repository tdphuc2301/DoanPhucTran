<?php

namespace App\Services\Notification;

use App\Mail\NotificationMail;
use App\Models\Order;

class NotificationService extends NotificationManager
{
    /**
     * @param Order $data
     */
    public function notifyNewOrder(){
        $mailable = new NotificationMail('new_order');
        $mailable->setData([
            'order_code' => 123,
        ]);
        $this->setMailAble($mailable)->send('thanhdoan1411998@gmail.com');
    }

    public function test(){
        return 123;
    }
}

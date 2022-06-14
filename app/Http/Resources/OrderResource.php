<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $promotion = $this->promotions ;
        $customer = $this->customers ;
        $orderDetail = $this->orderDetails ;
        $paid = $this->paids[0]->paid;
        $product = $this->products;
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name_customer' => $customer->name,
            'email_customer' => $customer->email,
            'address' => $customer->address,
            'promotion' => $promotion->id === 2 ? $promotion->value . '%' : $promotion->value . 'VNĐ',
            'total_price' => $this->total_price,
            'paid' => $this->toConvertPaid($paid),
            'paid_key' => $paid,
            'status_delivered' =>$this->status_delivered,
            'status_delivered_key'=>$this->toConvertDelivery($this->status_delivered),
            'status' => $this->status,
            'status_label' => config("common.status_label.$this->status"),
            'formatted_created_at' => $this->formatted_created_at ?? Carbon::parse($this->created_at)->format(config('common.date_format')),
            'formatted_updated_at' => $this->formatted_updated_at ?? Carbon::parse($this->updated_at)->format(config('common.date_format')),
        ];
    }

    public function toConvertPaid($paid)
    {
        $stringPaid ='';
        if($paid == 1) {
            $stringPaid =  "Chưa thanh toán";
        } else if($paid == 2) {
            $stringPaid = 'Thanh toán thất bại';
        } else if($paid == 3) {
            $stringPaid = 'Thanh toán thành công';
        } else if($paid == 4) {
            $stringPaid = 'Hủy đơn hàng';
        }
        
        return $stringPaid;
    }

    public function toConvertDelivery($paid)
    {
        $stringPaid ='';
        if($paid == 1) {
            $stringPaid =  "Chuẩn bị hàng";
        } else if($paid == 2) {
            $stringPaid = 'Đang giao hàng';
        } else if($paid == 3) {
            $stringPaid = 'Đã nhận hàng';
        } else if($paid == 4) {
            $stringPaid = 'Giao hàng thất bại';
        } else {
            $stringPaid = 'Hủy đơn hàng';
        }

        return $stringPaid;
    }
}

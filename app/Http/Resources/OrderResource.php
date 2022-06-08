<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name ? $this->customer->name:' ',
            'full_name' => $this->customer->full_name ? $this->customer->full_name:' ',
            'phone' => $this->customer->phone ? $this->customer->phone : ' ',
            'notes' => $this->notes,
            'voice_status' => $this->voice_status,
            'voice_status_name' => $this->voice_status(),
            'total_price' => $this->total_price(),
            'total_payment' => $this->total_payment(),
            'remaining' => $this->total_price() -$this->total_price_recieve()-$this->total_payment(),
            'created_at' => $this->created_at->format('d-m-y h:i A'),
            'updated_at' => $this->updated_at,
        ];
    
    }
}

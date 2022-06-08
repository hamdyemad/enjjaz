<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'price' => $this->price,      
            'remaining' => $this->remaining,
            'created_at' => $this->created_at->format('d-m-y h:i A'),
            'updated_at' => $this->updated_at,
        ];
    }
}

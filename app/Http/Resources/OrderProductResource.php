<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'name' => $this->product->name??' ',      
            'count' => $this->count,
            'remaining_count' => $this->remaining_count(),
            'price' => $this->price,
            'price_total' => $this->price_total,
            'created_at' => $this->created_at->format('d-m-y h:i A'),
            'updated_at' => $this->updated_at,
        ];
    
    }
}

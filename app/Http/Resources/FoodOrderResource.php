<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'food_id' => $this->food_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->format("Y-m-d H:m"),
            'updated_at' => $this->updated_at->format("Y-m-d H:m")
        ];
    }
}

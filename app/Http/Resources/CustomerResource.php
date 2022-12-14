<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'number_people' => $this->number_people,
            'code' => $this->code,
            'price' => $this->price,
            'created_at' => $this->created_at->format("Y-m-d H:m"),
            'updated_at' => $this->updated_at->format("Y-m-d H:m")
        ];
    }
}

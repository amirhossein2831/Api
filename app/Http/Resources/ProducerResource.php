<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducerResource extends JsonResource
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
            'productId'=>$this->product_id,
            'name'=>$this->name,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'notionalCode'=>$this->notional_code,
            'city'=>$this->city
        ];
    }
}

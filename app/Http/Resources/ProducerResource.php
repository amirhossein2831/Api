<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProducerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
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

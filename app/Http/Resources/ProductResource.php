<?php

namespace App\Http\Resources;

use App\Models\Producer;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
          'id'=>$this->id,
          'companyId'=>$this->company_id,
          'name'=>$this->name,
          'color'=>$this->color,
          'code'=>$this->code,
          'producers'=>ProducerResource::collection($this->whenLoaded('producers'))
        ];
    }
}

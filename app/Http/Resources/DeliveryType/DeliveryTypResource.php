<?php

namespace App\Http\Resources\DeliveryType;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTypResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'                 => $this->id,
            'delivery_type_name' => $this->delivery_type_name,
        ];
    }
}

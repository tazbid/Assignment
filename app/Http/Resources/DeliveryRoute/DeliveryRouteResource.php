<?php

namespace App\Http\Resources\DeliveryRoute;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryRouteResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'                  => $this->id,
            'delivery_route_name' => $this->delivery_route_name,
        ];
    }
}

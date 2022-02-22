<?php

namespace App\Http\Resources\PricingRule;

use App\Http\Resources\DeliveryRoute\DeliveryRouteResource;
use App\Http\Resources\DeliveryType\DeliveryTypResource;
use App\Http\Resources\Weight\WeightResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingRuleResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'                     => $this->id,
            'status'                 => $this->status,
            'expiration_date'        => $this->expiration_date,
            'pricing_rule'           => $this->pricing_rule,
            'weight_id'              => $this->weight_id,
            'weight_details'         => WeightResource::make($this->weightDetails),
            'delivery_route_id'      => $this->delivery_route_id,
            'delivery_route_details' => DeliveryRouteResource::make($this->deliveryRouteDetails),
            'delivery_type_id'       => $this->delivery_type_id,
            'delivery_type_details'  => DeliveryTypResource::make($this->deliveryTypeDetails),
            'created_at'             => $this->created_at,
        ];
    }
}

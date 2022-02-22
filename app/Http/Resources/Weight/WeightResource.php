<?php

namespace App\Http\Resources\Weight;

use Illuminate\Http\Resources\Json\JsonResource;

class WeightResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'          => $this->id,
            'weight_name' => $this->weight_name,
        ];
    }
}

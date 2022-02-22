<?php

namespace App\Services\DeliveryType;

use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\DeliveryType\DeliveryTypeModel;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class DeliveryTypeService {

    use UserTrait;

    /**
     * @name mapDeliveryTypeInsertAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDeliveryTypeInsertAttributes(Request $request) {
        return [
            'delivery_type_name' => $request->delivery_type_name,
        ];
    }

    /**
     * @name insertDeliveryType
     * @role insert a new delivery type into database
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function insertDeliveryType(Request $request) {
        try {
            $attributes    = $this->mapDeliveryTypeInsertAttributes($request);
            $deliveryType = DeliveryTypeModel::create($attributes);
            $deliveryType->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name mapDeliveryTypeUpdateAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDeliveryTypeUpdateAttributes(Request $request) {
        return [
            'delivery_type_name' => $request->delivery_type_name,
        ];
    }

    /**
     * @name updateDeliveryType
     * @role  update delivery type record into database
     * @param \Illuminate\Http\Request $request,App\Models\DeliveryRoute\DeliveryRouteModel $deliveryRoute
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function updateDeliveryType(Request $request, DeliveryTypeModel $deliveryType) {
        try {
            $attributes = $this->mapDeliveryTypeUpdateAttributes($request);
            $response   = $deliveryType->update($attributes);
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name deleteDeliveryType
     * @role  delete delivery type record from database
     * @param \App\Models\DeliveryType\DeliveryTypeModel $deliveryType
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function deleteDeliveryType(DeliveryTypeModel $deliveryType) {
        try {
            $response = $deliveryType->delete();
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

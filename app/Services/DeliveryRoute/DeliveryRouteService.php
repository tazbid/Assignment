<?php

namespace App\Services\DeliveryRoute;

use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class DeliveryRouteService {

    use UserTrait;

    /**
     * @name mapDeliveryRouteInsertAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDeliveryRouteInsertAttributes(Request $request) {
        return [
            'delivery_route_name' => $request->delivery_route_name,
        ];
    }

    /**
     * @name insertDeliveryRoute
     * @role insert a new delivery route into database
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function insertDeliveryRoute(Request $request) {
        try {
            $attributes    = $this->mapDeliveryRouteInsertAttributes($request);
            $deliveryRoute = DeliveryRouteModel::create($attributes);
            $deliveryRoute->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name mapDeliveryRouteUpdateAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDeliveryRouteUpdateAttributes(Request $request) {
        return [
            'delivery_route_name' => $request->delivery_route_name,
        ];
    }

    /**
     * @name updateDeliveryRoute
     * @role  update delivery route record into database
     * @param \Illuminate\Http\Request $request,App\Models\DeliveryRoute\DeliveryRouteModel $deliveryRoute
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function updateDeliveryRoute(Request $request, DeliveryRouteModel $deliveryRoute) {
        try {
            $attributes = $this->mapDeliveryRouteUpdateAttributes($request);
            $response   = $deliveryRoute->update($attributes);
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name deleteDeliveryRoute
     * @role  delete delivery route record from database
     * @param App\Models\DeliveryRoute\DeliveryRouteModel $deliveryRoute
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function deleteDeliveryRoute(DeliveryRouteModel $deliveryRoute) {
        try {
            $response = $deliveryRoute->delete();
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

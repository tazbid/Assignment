<?php

namespace App\Services\Weight;

use App\Models\User;
use App\Models\Weight\WeightModel;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class WeightService {

    use UserTrait;

    /**
     * @name mapWeightInsertAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapWeightInsertAttributes(Request $request) {
        return [
            'weight_name' => $request->weight_name,
        ];
    }

    /**
     * @name insertWeight
     * @role insert a new weight into database
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function insertWeight(Request $request) {
        try {
            $attributes = $this->mapWeightInsertAttributes($request);
            $weight     = WeightModel::create($attributes);
            $weight->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name mapWeightUpdateAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapWeightUpdateAttributes(Request $request) {
        return [
            'weight_name' => $request->weight_name,
        ];
    }

    /**
     * @name updateWeight
     * @role  update weight record into database
     * @param \Illuminate\Http\Request $request,App\Models\Weight\WeightModel $weight
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function updateWeight(Request $request, WeightModel $weight) {
        try {
            $attributes = $this->mapWeightUpdateAttributes($request);
            $response   = $weight->update($attributes);
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name deleteWeight
     * @role  delete weight record from database
     * @param App\Models\Weight\WeightModel $weight
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function deleteWeight(WeightModel $weight) {
        try {
            $response = $weight->delete();
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

<?php

namespace App\Services\PricingRule;

use App\Models\PricingRule\PricingRuleModel;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class PricingRuleService {

    use UserTrait;

    /**
     * @name mapPricingRuleInsertAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapPricingRuleInsertAttributes(Request $request) {
        return [
            'pricing_rule'      => $request->pricing_rule,
            'status'            => $this->active,
            'expiration_date'   => $request->expiration_date,
            'weight_id'         => $request->weight_id,
            'delivery_route_id' => $request->delivery_route_id,
            'delivery_type_id'  => $request->delivery_type_id,
        ];
    }

    /**
     * @name insertPricingRule
     * @role insert a new pricing rule into database
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function insertPricingRule(Request $request) {
        try {
            $attributes  = $this->mapPricingRuleInsertAttributes($request);
            $pricingRule = PricingRuleModel::create($attributes);
            $pricingRule->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name mapPricingRuleUpdateAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapPricingRuleUpdateAttributes(Request $request) {
        // $todaysDate = date('Y-m-d');
        // if($todaysDate > $request->expiration_date) {
        //     $status = $this->inactive;
        // } else {
        //     $status = $this->active;
        // }
        return [
            'pricing_rule'      => $request->pricing_rule,
            'expiration_date'   => $request->expiration_date,
            'weight_id'         => $request->weight_id,
            'delivery_route_id' => $request->delivery_route_id,
            'delivery_type_id'  => $request->delivery_type_id,
        ];
    }

    /**
     * @name updatePricingRule
     * @role  update pricing rule record into database
     * @param \Illuminate\Http\Request $request,App\Models\PricingRule\PricingRuleModel $pricingRule
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function updatePricingRule(Request $request, PricingRuleModel $pricingRule) {
        try {
            $attributes = $this->mapPricingRuleUpdateAttributes($request);
            $response   = $pricingRule->update($attributes);
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name deletePricingRule
     * @role  delete pricing rule record from database
     * @param \App\Models\PricingRule\PricingRuleModel $pricingRule
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function deletePricingRule(PricingRuleModel $pricingRule) {
        try {
            $response = $pricingRule->delete();
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @name getPricingRuleDetails
     * @role  get pricing rule details api
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function getPricingRuleDetails(Request $request) {
        try {
            $pricingRule = PricingRuleModel::where('weight_id', $request->weight_id)
                ->where('delivery_route_id', $request->delivery_route_id)
                ->where('delivery_type_id', $request->delivery_type_id)
                ->where('status', $this->active)
                ->first();
            return $pricingRule;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

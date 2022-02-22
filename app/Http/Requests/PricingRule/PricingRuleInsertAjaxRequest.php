<?php

namespace App\Http\Requests\PricingRule;

use Illuminate\Foundation\Http\FormRequest;

class PricingRuleInsertAjaxRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'expiration_date'   => 'required|date',
            'pricing_rule'      => 'required|numeric',
            'weight_id'         => 'required|exists:tbl_weight,id,deleted_at,NULL',
            'delivery_route_id' => 'required|exists:tbl_delivery_route,id,deleted_at,NULL',
            'delivery_type_id'  => 'required|exists:tbl_delivery_type,id,deleted_at,NULL',
        ];
    }
}

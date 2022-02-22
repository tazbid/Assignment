<?php

namespace App\Models\PricingRule;

use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\DeliveryType\DeliveryTypeModel;
use App\Models\Weight\WeightModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingRuleModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_pricing_rule';

    protected $fillable = [
        'pricing_rule',
        'status',
        'expiration_date',
        'weight_id',
        'delivery_route_id',
        'delivery_type_id',
    ];

    //weight details
    public function weightDetails()
    {
        return $this->belongsTo(WeightModel::class, 'weight_id', 'id');
    }
    //delivery route details
    public function deliveryRouteDetails()
    {
        return $this->belongsTo(DeliveryRouteModel::class, 'delivery_route_id', 'id');
    }
    //delivery type details
    public function deliveryTypeDetails()
    {
        return $this->belongsTo(DeliveryTypeModel::class, 'delivery_type_id', 'id');
    }

}

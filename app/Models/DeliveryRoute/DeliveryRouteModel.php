<?php

namespace App\Models\DeliveryRoute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryRouteModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tbl_delivery_route";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_route_name'
    ];

}

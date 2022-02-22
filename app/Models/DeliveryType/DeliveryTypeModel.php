<?php

namespace App\Models\DeliveryType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryTypeModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_delivery_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_type_name'
    ];
}

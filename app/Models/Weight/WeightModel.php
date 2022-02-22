<?php

namespace App\Models\Weight;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeightModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tbl_weight";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weight_name'
    ];

}

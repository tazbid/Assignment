<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRuleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pricing_rule', function (Blueprint $table) {
            $table->id();
            $table->double('pricing_rule');
            $table->boolean('status');
            $table->date('expiration_date');
            $table->foreignId('weight_id')->constrained('tbl_weight');
            $table->foreignId('delivery_route_id')->constrained('tbl_delivery_route');
            $table->foreignId('delivery_type_id')->constrained('tbl_delivery_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pricing_rule');
    }
}

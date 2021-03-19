<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReferralDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_discount_code', function (Blueprint $table) {
            $table->id();
            $table->string('referral_id');
            $table->string('shop_name');
            $table->string('discount_code')->nullable();
            $table->longText('discount_code_id')->nullable();
            $table->string('price_rule_id')->nullable();
            // $table->string('popup_order_status')->nullable();
            // $table->string('referrer_settings')->default('percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

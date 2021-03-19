<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('shop_name');
            $table->string('email_logo')->nullable();
            $table->longText('email_template_html')->nullable();
            $table->string('popup_all_website')->nullable();
            $table->string('popup_order_status')->nullable();
            $table->string('referrer_settings')->default('percentage');
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

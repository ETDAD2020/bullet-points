<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->string('popup_image')->nullable();
            $table->longText('popup_heading')->default('GIVE $10 GET $10');
            $table->longText('popup_description')->default('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour');
            $table->longText('referral_link_help_text')->default('Use this url to earn money yourself &amp; give discounts to your loved ones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            //
        });
    }
}

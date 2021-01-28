<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppSettings extends Migration
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
            $table->text('shopify_name');
            $table->string('disable_right_click')->nullable();
            $table->string('disable_f12')->nullable();
            $table->string('disable_copy')->nullable();
            $table->string('disable_ctrl_shift_i')->nullable();
            $table->string('disable_ctrl_anykey')->nullable();
            $table->string('disable_text_image_selection')->nullable();
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

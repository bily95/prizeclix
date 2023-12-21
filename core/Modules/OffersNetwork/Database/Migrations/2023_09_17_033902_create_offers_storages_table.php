<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_storages', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->string('uid');
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->text('click_url');
            $table->string('rewards');
            $table->string('payout');
            $table->text('device');
            $table->text('category');
            $table->text('country');
            $table->boolean('is_unlimited')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_banner')->default(0);
            $table->string('admin_extra_bonus')->nullable();
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
        Schema::dropIfExists('offers_storages');
    }
};

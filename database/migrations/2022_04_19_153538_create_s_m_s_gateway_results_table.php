<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_gateway_results', function (Blueprint $table) {
            $table->id();
            $table->string('to', 20)->index();
            $table->string('provider', 30)->index();
            $table->json('result')->nullable();
            $table->smallInteger('status_code')->default(200);
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
        Schema::dropIfExists('sms_gateway_results');
    }
};

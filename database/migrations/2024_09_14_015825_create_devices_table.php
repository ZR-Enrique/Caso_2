<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone_number')->unique();
        $table->string('status')->default('active');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('devices');
}
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la campaña
            $table->text('message'); // Mensaje a enviar
            $table->foreignId('device_id')->constrained(); // Relación con el dispositivo activo
            $table->string('status')->default('pending'); // Estado de la campaña (pending, sent, etc.)
            $table->string('file_path')->nullable(); // Ruta del archivo adjunto opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}

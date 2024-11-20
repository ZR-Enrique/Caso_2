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
    // Evitamos crear la tabla 'contact_tag' porque ya existe.
    // Schema::create('contact_tag', function (Blueprint $table) {
    //     $table->id();
    //     $table->unsignedBigInteger('contact_id');
    //     $table->unsignedBigInteger('tag_id');
    //     $table->timestamps();

    //     $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
    //     $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
    // });
}







    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_tag');
    }
};

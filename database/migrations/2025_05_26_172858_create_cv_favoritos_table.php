<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('cv_favoritos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // <- esta es la clave correcta
    $table->unsignedBigInteger('cv_id');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');

    $table->unique(['user_id', 'cv_id']);
});

}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_favoritos');
    }
};

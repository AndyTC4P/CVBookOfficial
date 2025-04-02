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
    Schema::create('cvs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nombre');
        $table->string('apellido');
        $table->string('titulo')->nullable();
        $table->text('perfil')->nullable();
        $table->string('imagen')->nullable();
        $table->string('correo')->nullable();
        $table->string('telefono')->nullable();
        $table->string('direccion')->nullable();
        $table->json('experiencia')->nullable(); // Se almacenará en formato JSON
        $table->json('educacion')->nullable(); // Se almacenará en formato JSON
        $table->boolean('publico')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_v_s');
    }
};

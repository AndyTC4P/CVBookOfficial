<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id'); // FK a users
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('categoria')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('modalidad')->nullable(); // Presencial / Remoto / Híbrido
            $table->string('tipo_contrato')->nullable(); // Tiempo completo, medio tiempo, etc.
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacantes');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacante_id');
            $table->unsignedBigInteger('usuario_id'); // postulante
            $table->unsignedBigInteger('cv_id'); // CV seleccionado
            $table->timestamp('fecha_postulacion')->useCurrent();

            $table->foreign('vacante_id')->references('id')->on('vacantes')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};


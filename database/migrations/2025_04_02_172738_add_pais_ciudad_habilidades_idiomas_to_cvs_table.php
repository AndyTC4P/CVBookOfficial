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
    Schema::table('cvs', function (Blueprint $table) {
        $table->string('pais')->nullable()->after('direccion');
        $table->string('ciudad')->nullable()->after('pais');
        $table->json('habilidades')->nullable()->after('educacion');
        $table->json('idiomas')->nullable()->after('habilidades');
    });
}

public function down(): void
{
    Schema::table('cvs', function (Blueprint $table) {
        $table->dropColumn(['pais', 'ciudad', 'habilidades', 'idiomas']);
    });
}

};

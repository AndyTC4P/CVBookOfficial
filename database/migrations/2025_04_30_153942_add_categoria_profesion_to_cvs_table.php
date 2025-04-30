<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cvs', function (Blueprint $table) {
            if (!Schema::hasColumn('cvs', 'categoria_profesion')) {
                $table->string('categoria_profesion')->nullable()->after('apellido');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->dropColumn('categoria_profesion');
        });
    }
};


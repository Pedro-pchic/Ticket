<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->string('ubicacion')->nullable()->after('departamento');
        $table->string('extension')->nullable()->after('ubicacion');
        $table->string('equipo_afectado')->nullable()->after('extension');
        $table->foreignId('tecnico_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
        $table->string('adjunto')->nullable()->after('estado');
    });
}

public function down(): void
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropForeign(['tecnico_id']);
        $table->dropColumn([
            'tecnico_id',
            'ubicacion',
            'extension',
            'equipo_afectado',
            'adjunto',
        ]);
    });
}
};
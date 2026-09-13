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
        Schema::create('gempa_kalimantans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu_gempa');
            $table->decimal('magnitudo', 3, 1);
            $table->string('kedalaman', 50);
            $table->string('wilayah');
            $table->text('keterangan')->nullable();
            $table->string('koordinat', 100);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gempa_kalimantans');
    }
};

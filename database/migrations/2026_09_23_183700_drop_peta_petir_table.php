<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bersihkan data media library terkait model PetaPetir jika ada
        if (Schema::hasTable('media')) {
            DB::table('media')->where('model_type', 'App\\Models\\PetaPetir')->delete();
        }

        Schema::dropIfExists('peta_petir');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('peta_petir', function (Blueprint $table) {
            $table->id();
            $table->date('periode');
            $table->longText('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};

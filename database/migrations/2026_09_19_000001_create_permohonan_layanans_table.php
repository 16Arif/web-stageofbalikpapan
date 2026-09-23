<?php

declare(strict_types=1);

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
        Schema::create('permohonan_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket', 32)->unique();
            $table->foreignId('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->string('kategori_layanan', 50);
            $table->string('judul_permohonan');
            $table->text('rincian_kebutuhan');
            $table->string('tujuan_penggunaan', 100);
            $table->string('tipe_tarif', 50)->default('tarif_nol_rupiah');
            $table->string('berkas_permohonan')->nullable();
            $table->string('berkas_pendukung')->nullable();
            $table->string('status', 50)->default('diajukan');
            $table->text('catatan_petugas')->nullable();
            $table->string('kode_billing_simponi', 50)->nullable();
            $table->decimal('nominal_pnbp', 14, 2)->nullable();
            $table->timestamp('expired_billing_at')->nullable();
            $table->string('berkas_bukti_bayar')->nullable();
            $table->string('berkas_hasil_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_layanans');
    }
};

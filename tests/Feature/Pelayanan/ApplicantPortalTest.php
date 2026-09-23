<?php

declare(strict_types=1);

namespace Tests\Feature\Pelayanan;

use App\Models\Applicant;
use App\Models\PermohonanLayanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApplicantPortalTest extends TestCase
{
    use RefreshDatabase;

    protected Applicant $applicant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->applicant = Applicant::create([
            'name' => 'Ahmad Pemohon',
            'identity_number' => '6471019900010001',
            'tipe_pemohon' => 'pribadi',
            'phone' => '081234567890',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('Password123!'),
            'is_active' => true,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_portal_dashboard(): void
    {
        $response = $this->get('/pelayanan/portal');

        $response->assertRedirect(route('pelayanan.login'));
    }

    public function test_authenticated_applicant_can_access_portal_dashboard(): void
    {
        $response = $this->actingAs($this->applicant, 'applicant')
            ->get('/pelayanan/portal');

        $response->assertStatus(200);
        $response->assertSee('Portal Layanan Data Stasiun Geofisika Balikpapan');
    }

    public function test_applicant_only_sees_their_own_permohonan_data(): void
    {
        // Buat permohonan milik applicant ini
        $myRequest = PermohonanLayanan::create([
            'applicant_id' => $this->applicant->id,
            'kategori_layanan' => PermohonanLayanan::KATEGORI_GEMPABUMI,
            'judul_permohonan' => 'Data Gempa Kaltim Milik Saya',
            'rincian_kebutuhan' => 'Wilayah IKN 2024',
            'tujuan_penggunaan' => 'penelitian_skripsi',
            'tipe_tarif' => PermohonanLayanan::TARIF_NOL_RUPIAH,
            'status' => PermohonanLayanan::STATUS_DIAJUKAN,
        ]);

        // Buat applicant lain dan permohonannya
        $otherApplicant = Applicant::create([
            'name' => 'User Lain',
            'identity_number' => '6471019900010002',
            'tipe_pemohon' => 'pribadi',
            'phone' => '081298765432',
            'email' => 'other@example.com',
            'password' => Hash::make('Password123!'),
            'is_active' => true,
        ]);

        $otherRequest = PermohonanLayanan::create([
            'applicant_id' => $otherApplicant->id,
            'kategori_layanan' => PermohonanLayanan::KATEGORI_PETIR,
            'judul_permohonan' => 'Data Petir Milik Orang Lain',
            'rincian_kebutuhan' => 'Wilayah Balikpapan',
            'tujuan_penggunaan' => 'klaim_asuransi',
            'tipe_tarif' => PermohonanLayanan::TARIF_PNBP,
            'status' => PermohonanLayanan::STATUS_DIAJUKAN,
        ]);

        $response = $this->actingAs($this->applicant, 'applicant')
            ->get('/pelayanan/portal/permohonan-sayas');

        $response->assertStatus(200);
        $response->assertSee('Data Gempa Kaltim Milik Saya');
        $response->assertDontSee('Data Petir Milik Orang Lain');
    }
}

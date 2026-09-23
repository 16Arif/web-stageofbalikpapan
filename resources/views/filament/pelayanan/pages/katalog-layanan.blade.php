<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">

        {{-- Banner Panduan Pengajuan --}}
        <x-filament::section icon="heroicon-o-information-circle" icon-color="primary">
            <x-slot name="heading">
                Portal Pengajuan Layanan Data Geofisika
            </x-slot>

            <x-slot name="afterHeader">
                <x-filament::badge color="primary">
                    Stasiun Geofisika Balikpapan
                </x-filament::badge>
            </x-slot>

            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <p style="font-size: 0.875rem; line-height: 1.5; color: var(--color-gray-600, #4b5563);">
                    Silakan tentukan jenis layanan data geofisika yang Anda butuhkan di bawah ini. Setelah memilih salah satu layanan, Anda akan diarahkan ke <strong>formulir pengajuan berjenjang (3 langkah)</strong> untuk melengkapi spesifikasi parameter teknis dan mengunggah berkas persyaratan.
                </p>

                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.75rem; padding-top: 0.25rem;">
                    <x-filament::badge color="success" icon="heroicon-m-check">
                        Tersedia Tarif Rp 0,- (Riset Skripsi & Kebencanaan)
                    </x-filament::badge>
                    <x-filament::badge color="warning" icon="heroicon-m-banknotes">
                        Pembayaran Cashless via Kode Billing Simponi Kemenkeu
                    </x-filament::badge>
                </div>
            </div>
        </x-filament::section>

        {{-- Grid 4 Kartu Layanan Geofisika --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; align-items: stretch;">

            {{-- Kartu 1: Informasi Kegempaan --}}
            <x-filament::section icon="heroicon-o-globe-alt" icon-color="info" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <x-slot name="heading">
                    Informasi Kegempaan
                </x-slot>

                <x-slot name="afterHeader">
                    <x-filament::badge color="info">
                        PP 47/2018
                    </x-filament::badge>
                </x-slot>

                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--color-gray-600, #4b5563); margin-bottom: 1rem;">
                            Penyediaan data katalog kegempaan, peta seismisitas regional Kalimantan, peta percepatan tanah puncak (PGA), serta surat keterangan kejadian gempabumi untuk analisis rekayasa konstruksi sipil tahan gempa.
                        </p>

                        <div style="border-top: 1px solid rgba(156, 163, 175, 0.2); padding-top: 0.75rem; margin-bottom: 1rem;">
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-gray-400, #9ca3af); margin-bottom: 0.5rem;">
                                Layanan yang Dicakup:
                            </p>
                            <ul style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.8125rem; list-style: none; padding: 0; margin: 0;">
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Peta Kegempaan Regional Kalimantan</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Peta Percepatan Tanah (PGA) Konstruksi</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Surat Keterangan Kejadian Gempabumi</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <x-slot name="footer">
                    <x-filament::button
                        tag="a"
                        :href="route('filament.pelayanan.resources.permohonan-sayas.create', ['kategori' => 'gempabumi', 'layanan' => 'Informasi Kegempaan'])"
                        color="info"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                        style="width: 100%; justify-content: center;"
                    >
                        Pilih & Ajukan Layanan Ini
                    </x-filament::button>
                </x-slot>
            </x-filament::section>

            {{-- Kartu 2: Informasi Sambaran Petir --}}
            <x-filament::section icon="heroicon-o-bolt" icon-color="warning" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <x-slot name="heading">
                    Informasi Sambaran Petir
                </x-slot>

                <x-slot name="afterHeader">
                    <x-filament::badge color="warning">
                        PP 47/2018
                    </x-filament::badge>
                </x-slot>

                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--color-gray-600, #4b5563); margin-bottom: 1rem;">
                            Informasi presisi titik sambaran petir CG (Cloud-to-Ground) & IC berbasis jaringan sensor Lightning Detector BMKG untuk audit proteksi kelistrikan dan klaim asuransi kerusakan peralatan.
                        </p>

                        <div style="border-top: 1px solid rgba(156, 163, 175, 0.2); padding-top: 0.75rem; margin-bottom: 1rem;">
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-gray-400, #9ca3af); margin-bottom: 0.5rem;">
                                Layanan yang Dicakup:
                            </p>
                            <ul style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.8125rem; list-style: none; padding: 0; margin: 0;">
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Surat Keterangan Petir (SKP) Klaim Asuransi</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Data Rekapitulasi Sambaran Petir Harian</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Peta Tingkat Kerawanan & Kerapatan Petir</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <x-slot name="footer">
                    <x-filament::button
                        tag="a"
                        :href="route('filament.pelayanan.resources.permohonan-sayas.create', ['kategori' => 'petir', 'layanan' => 'Informasi Sambaran Petir'])"
                        color="warning"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                        style="width: 100%; justify-content: center;"
                    >
                        Pilih & Ajukan Layanan Ini
                    </x-filament::button>
                </x-slot>
            </x-filament::section>

            {{-- Kartu 3: Kunjungan & Edukasi Mitigasi --}}
            <x-filament::section icon="heroicon-o-academic-cap" icon-color="success" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <x-slot name="heading">
                    Kunjungan & Edukasi Mitigasi
                </x-slot>

                <x-slot name="afterHeader">
                    <x-filament::badge color="success">
                        Tarif Rp 0,-
                    </x-filament::badge>
                </x-slot>

                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--color-gray-600, #4b5563); margin-bottom: 1rem;">
                            Fasilitas studi lapangan, kunjungan instansi/sekolah ke kantor operasional Stasiun Geofisika Balikpapan, serta permohonan narasumber sosialisasi mitigasi bencana gempabumi & tsunami.
                        </p>

                        <div style="border-top: 1px solid rgba(156, 163, 175, 0.2); padding-top: 0.75rem; margin-bottom: 1rem;">
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-gray-400, #9ca3af); margin-bottom: 0.5rem;">
                                Layanan yang Dicakup:
                            </p>
                            <ul style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.8125rem; list-style: none; padding: 0; margin: 0;">
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Wisata Edukasi Geofisika di Kantor Operasional</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Program BMKG Goes to School / Kampus</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Permohonan Narasumber Sosialisasi Kebencanaan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <x-slot name="footer">
                    <x-filament::button
                        tag="a"
                        :href="route('filament.pelayanan.resources.permohonan-sayas.create', ['kategori' => 'konsultasi', 'layanan' => 'Kunjungan & Edukasi Mitigasi', 'tarif' => 'tarif_nol_rupiah', 'tujuan' => 'kegiatan_edukasi'])"
                        color="success"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                        style="width: 100%; justify-content: center;"
                    >
                        Pilih & Ajukan Kunjungan
                    </x-filament::button>
                </x-slot>
            </x-filament::section>

            {{-- Kartu 4: Jasa Konsultasi Geofisika --}}
            <x-filament::section icon="heroicon-o-chat-bubble-bottom-center-text" icon-color="primary" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <x-slot name="heading">
                    Jasa Konsultasi Geofisika
                </x-slot>

                <x-slot name="afterHeader">
                    <x-filament::badge color="info">
                        PP 47/2018
                    </x-filament::badge>
                </x-slot>

                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--color-gray-600, #4b5563); margin-bottom: 1rem;">
                            Konsultasi teknis pendahuluan parameter geofisika untuk mendukung survei kelayakan proyek konstruksi, riset korporasi, serta kajian risiko seismotektonik kawasan IKN dan Kalimantan Timur.
                        </p>

                        <div style="border-top: 1px solid rgba(156, 163, 175, 0.2); padding-top: 0.75rem; margin-bottom: 1rem;">
                            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-gray-400, #9ca3af); margin-bottom: 0.5rem;">
                                Layanan yang Dicakup:
                            </p>
                            <ul style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.8125rem; list-style: none; padding: 0; margin: 0;">
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Informasi Pendahuluan Geofisika Proyek</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Kajian Seismotektonik Kawasan IKN</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 1rem; height: 1rem; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Dukungan Teknis Riset Non-Komersial</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <x-slot name="footer">
                    <x-filament::button
                        tag="a"
                        :href="route('filament.pelayanan.resources.permohonan-sayas.create', ['kategori' => 'konsultasi', 'layanan' => 'Jasa Konsultasi Geofisika', 'tarif' => 'tarif_pnbp'])"
                        color="primary"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                        style="width: 100%; justify-content: center;"
                    >
                        Pilih & Ajukan Konsultasi
                    </x-filament::button>
                </x-slot>
            </x-filament::section>

        </div>

        {{-- Bantuan & Tautan Cepat --}}
        <x-filament::section>
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 0.75rem; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h4 style="font-size: 0.875rem; font-weight: 700; margin: 0;">Sudah Pernah Mengajukan Permohonan?</h4>
                        <p style="font-size: 0.75rem; color: var(--color-gray-500, #6b7280); margin: 0.25rem 0 0 0;">Pantau progres verifikasi, kode billing Simponi, dan unduh data Anda di menu Permohonan Saya.</p>
                    </div>
                </div>

                <x-filament::button
                    tag="a"
                    :href="route('filament.pelayanan.resources.permohonan-sayas.index')"
                    color="gray"
                    icon="heroicon-m-document-duplicate"
                >
                    Buka Permohonan Saya
                </x-filament::button>
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>

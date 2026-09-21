<div class="min-h-screen w-full relative overflow-x-hidden flex flex-col justify-between bg-[#f8fafc]"
     style="background-image: radial-gradient(#cbd5e1 1.2px, transparent 1.2px); background-size: 24px 24px;"
     x-data="{ showPassword: false }">

    <!-- Container Utama -->
    <div class="w-full flex-1 flex flex-col lg:flex-row relative z-10 min-h-screen">
        
        <!-- SISI KIRI: Formulir Registrasi Pemohon Data -->
        <div class="w-full lg:w-[52%] xl:w-[48%] flex flex-col justify-between px-6 py-8 sm:px-12 md:px-16 lg:pl-16 lg:pr-10 xl:pl-24 xl:pr-14 z-20">
            
            <!-- Header Atas: Logo & Navigasi Balik -->
            <div>
                <a href="{{ route('home_page') }}" class="inline-flex items-center gap-3.5 group">
                    <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-11 w-auto group-hover:scale-105 transition-transform" />
                    <div>
                        <span class="block text-base font-extrabold tracking-tight text-[#002b66] leading-tight">
                            Stasiun Geofisika Balikpapan
                        </span>
                        <span class="block text-xs font-semibold text-slate-500 tracking-wide mt-0.5">
                            Badan Meteorologi, Klimatologi, dan Geofisika
                        </span>
                    </div>
                </a>

                <!-- Indikator Bahasa & Navigasi ke Login -->
                <div class="mt-6 flex items-center justify-between text-xs font-semibold">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 text-slate-800">
                            <span class="text-sm">🇮🇩</span> Bahasa Indonesia
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bagian Form Tengah -->
            <div class="my-auto py-5 sm:py-6 max-w-lg w-full">
                <!-- Greeting Header Khas BPS SSO -->
                <div class="mb-5">
                    <h2 class="text-xl sm:text-2xl text-slate-500 font-normal tracking-tight">
                        Registrasi Pemohon Data
                    </h2>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#002b66] tracking-tight leading-tight mt-0.5">
                        Sahabat Data!
                    </h1>
                    <p class="mt-1.5 text-xs text-slate-600 leading-relaxed">
                        Lengkapi profil pemohon Anda untuk mengajukan permohonan data dan jasa kebumian resmi.
                    </p>
                </div>

                <!-- Formulir Registrasi -->
                <form wire:submit="register" class="space-y-3.5">
                    
                    <!-- Baris 1: Nama Lengkap & Nomor Identitas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="name" class="block text-xs font-semibold text-slate-800 mb-1">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="name"
                                id="name"
                                type="text"
                                autocomplete="name"
                                required
                                placeholder="Nama sesuai identitas"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('name')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="identity_number" class="block text-xs font-semibold text-slate-800 mb-1">
                                No. Identitas (NIK/NIM/Paspor) <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="identity_number"
                                id="identity_number"
                                type="text"
                                required
                                placeholder="Contoh: 647101xxxxxx / 2109xxxx"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('identity_number') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('identity_number')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: Toggle Tipe Pemohon (Pribadi vs Institusi / Perusahaan) -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-800 mb-1">
                            Tipe Pemohon <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-2 p-1 bg-slate-200/70 rounded-xl border border-slate-200">
                            <button
                                type="button"
                                wire:click="$set('tipe_pemohon', 'pribadi')"
                                class="py-1.5 px-3 text-xs sm:text-sm font-bold rounded-lg transition duration-150 flex items-center justify-center gap-1.5 cursor-pointer {{ $tipe_pemohon === 'pribadi' ? 'bg-[#002b66] text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Pribadi
                            </button>

                            <button
                                type="button"
                                wire:click="$set('tipe_pemohon', 'institusi')"
                                class="py-1.5 px-3 text-xs sm:text-sm font-bold rounded-lg transition duration-150 flex items-center justify-center gap-1.5 cursor-pointer {{ $tipe_pemohon === 'institusi' ? 'bg-[#002b66] text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Institusi / Perusahaan
                            </button>
                        </div>
                    </div>

                    <!-- Input Nama Instansi / Perusahaan (Aktif Jika Institusi Dipilih) -->
                    @if ($tipe_pemohon === 'institusi')
                        <div class="transition-all duration-200">
                            <label for="institution_name" class="block text-xs font-semibold text-slate-800 mb-1">
                                Nama Instansi / Perusahaan / Kampus <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="institution_name"
                                id="institution_name"
                                type="text"
                                required
                                placeholder="Contoh: Universitas Mulawarman / PT Geosains Nusantara"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('institution_name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('institution_name')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Baris 3: No. HP / WhatsApp & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-slate-800 mb-1">
                                No. HP / WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="phone"
                                id="phone"
                                type="tel"
                                required
                                placeholder="Contoh: 081234567890"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('phone') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('phone')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-800 mb-1">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="email"
                                id="email"
                                type="email"
                                autocomplete="email"
                                required
                                placeholder="nama@email.com"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('email')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 4: Alamat Pemohon -->
                    <div>
                        <label for="address" class="block text-xs font-semibold text-slate-800 mb-1">
                            Alamat Lengkap (Domisili / Instansi)
                        </label>
                        <input
                            wire:model.defer="address"
                            id="address"
                            type="text"
                            placeholder="Jl. Contoh No. 123, Balikpapan / Samarinda"
                            class="block w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 focus:border-[#002b66] focus:ring-blue-100 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                        />
                    </div>

                    <!-- Baris 5: Kata Sandi & Konfirmasi Kata Sandi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-800 mb-1">
                                Kata Sandi <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="password"
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Min. 8 karakter"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                            @error('password')
                                <p class="mt-1 text-[11px] text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-slate-800 mb-1">
                                Konfirmasi Sandi <span class="text-rose-500">*</span>
                            </label>
                            <input
                                wire:model.defer="password_confirmation"
                                id="password_confirmation"
                                :type="showPassword ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Ulangi kata sandi"
                                class="block w-full px-3.5 py-2.5 rounded-xl bg-white border border-slate-300 focus:border-[#002b66] focus:ring-blue-100 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-3 transition text-sm shadow-2xs"
                            />
                        </div>
                    </div>

                    <!-- Tampilkan Password Toggle -->
                    <div class="flex items-center pt-0.5">
                        <label class="inline-flex items-center cursor-pointer select-none">
                            <input
                                type="checkbox"
                                @click="showPassword = !showPassword"
                                class="h-4 w-4 rounded border-slate-300 text-[#002b66] focus:ring-[#002b66] cursor-pointer"
                            />
                            <span class="ml-2 text-xs text-slate-600">Tampilkan Kata Sandi</span>
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            style="background-color: #002b66;"
                            class="w-full inline-flex items-center justify-center px-8 py-2.5 rounded-xl text-sm font-bold text-white bg-[#002b66] hover:bg-[#001f4d] active:bg-[#00173a] shadow-md shadow-[#002b66]/20 transition duration-150 cursor-pointer disabled:opacity-60"
                        >
                            <span wire:loading.remove>Daftar Akun Pemohon</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses Pendaftaran...
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Tautan Kembali ke Login -->
                <div class="mt-5 pt-4 border-t border-slate-200/80 text-xs sm:text-sm text-slate-600">
                    Sudah memiliki akun pemohon?
                    <a href="{{ route('pelayanan.login') }}" wire:navigate class="font-bold text-slate-900 hover:text-[#002b66] hover:underline transition ml-1">
                        Masuk disini
                    </a>
                </div>
            </div>

            <!-- Footer Bawah: Kontak Dukungan Resmi -->
            <div class="pt-3 border-t border-slate-200/80 text-xs text-slate-500">
                Butuh bantuan pendaftaran? Hubungi
                <a href="mailto:stageof.balikpapan@bmkg.go.id" class="underline text-slate-700 hover:text-[#002b66] font-medium">
                    stageof.balikpapan@bmkg.go.id
                </a>
            </div>
        </div>

        <!-- SISI KANAN: Visual BPS-Style Arch, Accents & Data Illustration -->
        <div class="hidden lg:flex lg:w-[48%] xl:w-[52%] relative min-h-screen items-center justify-center overflow-hidden">
            
            <!-- Curved Navy Shape (#002b66) khas BPS SSO -->
            <div class="absolute inset-y-0 right-0 w-full h-full pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 700 900" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M220 0C140 180 90 350 190 520C290 690 250 820 180 900H700V0H220Z" fill="#002b66" />
                </svg>
            </div>

            <!-- Aksen Lingkaran Hijau Zamrud (#00ba70) di Atas Kurva -->
            <div class="absolute -top-10 left-[16%] xl:left-[20%] w-36 h-36 rounded-full bg-[#00ba70] shadow-xl pointer-events-none"></div>

            <!-- Aksen Lingkaran Oranye (#ea580c) di Bawah Kurva -->
            <div class="absolute bottom-6 left-[20%] xl:left-[24%] w-28 h-28 rounded-full bg-[#ea580c] shadow-lg pointer-events-none"></div>

            <!-- Komposisi Kartu & Ilustrasi Pemohon Data -->
            <div class="relative z-10 w-full max-w-xl px-6 py-12 flex flex-col items-center">
                
                <!-- Floating Card 1: Jendela Manfaat Pendaftaran Akun -->
                <div class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-2xl p-5 shadow-2xl border border-white/50 mb-6 transform -rotate-1 hover:rotate-0 transition duration-300">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-rose-400 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 inline-block"></span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Portal Pelayanan Pemohon</span>
                    </div>

                    <div class="mt-4 space-y-2.5">
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-xs text-slate-700">Pengajuan data gempabumi & petir resmi secara terstruktur</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-xs text-slate-700">Pelacakan status verifikasi berkas dan penerbitan nota PNBP</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-xs text-slate-700">Fasilitas tarif Rp 0,- untuk mahasiswa & penelitian bersyarat</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Card 2 & Ilustrasi -->
                <div class="w-full max-w-lg flex items-end justify-between gap-4">
                    
                    <!-- Kartu Pemohon Terverifikasi -->
                    <div class="w-48 bg-white/95 backdrop-blur-md rounded-2xl p-4 shadow-xl border border-white/50 transform translate-y-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center mx-auto mb-2 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-center text-slate-800">Akun Pemohon Resmi</p>
                        <p class="text-[10px] text-center text-slate-500">Kredensial Aman & Terenkripsi</p>
                        <div class="mt-3 pt-2 border-t border-slate-100 flex justify-center">
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                Terverifikasi
                            </span>
                        </div>
                    </div>

                    <!-- Ilustrasi Karakter Diskusi Vektor Flat -->
                    <div class="flex-1">
                        <svg class="w-full h-auto drop-shadow-xl" viewBox="0 0 320 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Meja -->
                            <rect x="20" y="145" width="280" height="12" rx="6" fill="#e2e8f0" />
                            <rect x="50" y="157" width="8" height="60" rx="4" fill="#cbd5e1" />
                            <rect x="262" y="157" width="8" height="60" rx="4" fill="#cbd5e1" />

                            <!-- Karakter Kiri (Petugas Pelayanan BMKG) -->
                            <path d="M25 130 H45 V215 H35 V160 H25 Z" fill="#94a3b8" />
                            <ellipse cx="65" cy="140" rx="26" ry="32" fill="#1d4ed8" />
                            <path d="M75 130 L115 110" stroke="#a16207" stroke-width="7" stroke-linecap="round" />
                            <circle cx="125" cy="105" r="14" stroke="#0f172a" stroke-width="4" fill="#e0f2fe" />
                            <line x1="135" y1="115" x2="147" y2="127" stroke="#0f172a" stroke-width="5" stroke-linecap="round" />
                            <circle cx="65" cy="85" r="18" fill="#ca8a04" />
                            <path d="M48 85 C48 68 62 65 72 65 C82 65 85 75 85 85 C75 80 55 80 48 85 Z" fill="#1e293b" />
                            <rect x="45" y="165" width="16" height="50" rx="8" fill="#1e3a8a" />
                            <rect x="68" y="165" width="16" height="50" rx="8" fill="#1e3a8a" />
                            <rect x="38" y="210" width="28" height="10" rx="4" fill="#0f172a" />
                            <rect x="68" y="210" width="28" height="10" rx="4" fill="#0f172a" />

                            <!-- Karakter Kanan (Pemohon Mahasiswa/Peneliti) -->
                            <path d="M295 130 H275 V215 H285 V160 H295 Z" fill="#94a3b8" />
                            <ellipse cx="250" cy="138" rx="25" ry="30" fill="#e11d48" />
                            <circle cx="250" cy="85" r="18" fill="#fbcfe8" />
                            <circle cx="243" cy="84" r="5" stroke="#0f172a" stroke-width="2" fill="none" />
                            <circle cx="257" cy="84" r="5" stroke="#0f172a" stroke-width="2" fill="none" />
                            <line x1="248" y1="84" x2="252" y2="84" stroke="#0f172a" stroke-width="2" />
                            <ellipse cx="250" cy="68" rx="14" ry="12" fill="#78350f" />
                            <circle cx="262" cy="62" r="8" fill="#78350f" />
                            <rect x="235" y="165" width="18" height="50" rx="8" fill="#059669" />
                            <rect x="260" y="165" width="18" height="50" rx="8" fill="#059669" />
                            <rect x="228" y="210" width="28" height="10" rx="4" fill="#0f172a" />
                            <rect x="255" y="210" width="28" height="10" rx="4" fill="#0f172a" />

                            <!-- Dokumen Berkas di Meja -->
                            <rect x="135" y="130" width="50" height="17" rx="3" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.5" />
                            <line x1="142" y1="135" x2="175" y2="135" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="142" y1="140" x2="168" y2="140" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

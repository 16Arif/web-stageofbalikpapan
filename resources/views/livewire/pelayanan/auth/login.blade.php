<div class="min-h-screen w-full relative overflow-x-hidden flex flex-col justify-between bg-[#f8fafc]"
     style="background-image: radial-gradient(#cbd5e1 1.2px, transparent 1.2px); background-size: 24px 24px;"
     x-data="{ showPassword: false }">

    <!-- Container Konten -->
    <div class="w-full flex-1 flex flex-col lg:flex-row relative z-10 min-h-screen">
        
        <!-- SISI KIRI: Formulir Login Persis BPS SSO -->
        <div class="w-full lg:w-[50%] xl:w-[45%] flex flex-col justify-between px-6 py-8 sm:px-12 md:px-16 lg:pl-20 lg:pr-12 xl:pl-28 xl:pr-16 z-20">
            
            <!-- Header Atas: Logo & Bahasa -->
            <div>
                <a href="{{ route('home_page') }}" class="inline-flex items-center gap-3.5 group">
                    <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-12 w-auto group-hover:scale-105 transition-transform" />
                    <div>
                        <span class="block text-base font-extrabold tracking-tight text-[#002b66] leading-tight">
                            Stasiun Geofisika Balikpapan
                        </span>
                        <span class="block text-xs font-semibold text-slate-500 tracking-wide mt-0.5">
                            Badan Meteorologi, Klimatologi, dan Geofisika
                        </span>
                    </div>
                </a>

                <!-- Indikator Bahasa / Tautan Balik -->
                <div class="mt-8 flex items-center gap-2.5 text-xs font-semibold">
                    <span class="inline-flex items-center gap-1.5 text-slate-800">
                        <span class="text-sm">🇮🇩</span> Bahasa Indonesia
                    </span>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('pelayanan') }}" wire:navigate class="text-slate-500 hover:text-[#002b66] transition inline-flex items-center gap-1">
                        ← Kembali ke Layanan Data
                    </a>
                </div>
            </div>

            <!-- Bagian Form Tengah -->
            <div class="my-auto py-8 sm:py-10 max-w-md w-full">
                <!-- Greeting Header Khas BPS SSO -->
                <div class="mb-7">
                    <h2 class="text-2xl sm:text-3xl text-slate-500 font-normal tracking-tight">
                        Selamat datang
                    </h2>
                    <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-[#002b66] tracking-tight leading-tight mt-1">
                        Sahabat Data!
                    </h1>
                </div>

                <!-- Alert Feedback (Error / Sukses) -->
                @if (session('status'))
                    <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-800 flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->has('email') && !str_contains($errors->first('email'), 'wajib') && !str_contains($errors->first('email'), 'valid'))
                    <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-sm text-rose-800 flex items-start gap-3">
                        <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif

                <!-- Formulir Login -->
                <form wire:submit="authenticate" class="space-y-4">
                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-800 mb-1.5">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <input
                            wire:model.defer="email"
                            id="email"
                            type="email"
                            autocomplete="email"
                            required
                            placeholder="nama@email.com"
                            class="block w-full px-4 py-3 rounded-xl bg-white border @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 transition text-sm shadow-2xs"
                        />
                        @error('email')
                            @if (str_contains($message, 'wajib') || str_contains($message, 'valid'))
                                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @endif
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-800 mb-1.5">
                            Password <span class="text-rose-500">*</span>
                        </label>
                        <input
                            wire:model.defer="password"
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            autocomplete="current-password"
                            required
                            placeholder="••••••••"
                            class="block w-full px-4 py-3 rounded-xl bg-white border @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @else border-slate-300 focus:border-[#002b66] focus:ring-blue-100 @enderror text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 transition text-sm shadow-2xs"
                        />
                        @error('password')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tampilkan Password (Gaya BPS SSO) -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex items-center cursor-pointer select-none">
                            <input
                                type="checkbox"
                                @click="showPassword = !showPassword"
                                class="h-4 w-4 rounded border-slate-300 text-[#002b66] focus:ring-[#002b66] cursor-pointer"
                            />
                            <span class="ml-2 text-sm text-slate-600">Tampilkan Password</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer select-none">
                            <input
                                wire:model="remember"
                                type="checkbox"
                                class="h-4 w-4 rounded border-slate-300 text-[#002b66] focus:ring-[#002b66] cursor-pointer"
                            />
                            <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Tombol Masuk & Lupa Password -->
                    <div class="flex items-center justify-between pt-3">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            style="background-color: #002b66;"
                            class="inline-flex items-center justify-center px-9 py-2.5 rounded-xl text-sm font-bold text-white bg-[#002b66] hover:bg-[#001f4d] active:bg-[#00173a] shadow-md transition duration-150 cursor-pointer disabled:opacity-60"
                        >
                            <span wire:loading.remove>Masuk</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>

                        <a href="mailto:stageof.balikpapan@bmkg.go.id?subject=Bantuan%20Reset%20Kata%20Sandi%20Layanan%20Data" class="text-sm font-medium text-slate-500 hover:text-[#002b66] hover:underline transition">
                            Lupa password?
                        </a>
                    </div>
                </form>

                <!-- Ajakan Daftar Akun -->
                <div class="mt-8 pt-5 text-sm text-slate-600">
                    Belum punya akun?
                    @if (Route::has('pelayanan.register'))
                        <a href="{{ route('pelayanan.register') }}" wire:navigate class="font-bold text-slate-900 hover:text-[#002b66] hover:underline transition ml-1">
                            Daftar disini
                        </a>
                    @else
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate class="font-bold text-slate-900 hover:text-[#002b66] hover:underline transition ml-1">
                            Daftar disini
                        </a>
                    @endif
                </div>
            </div>

            <!-- Footer Bawah: Kontak Dukungan Resmi -->
            <div class="pt-4 border-t border-slate-200/80 text-xs text-slate-500">
                Butuh bantuan? Hubungi support di
                <a href="mailto:stageof.balikpapan@bmkg.go.id" class="underline text-slate-700 hover:text-[#002b66] font-medium">
                    stageof.balikpapan@bmkg.go.id
                </a>
            </div>
        </div>

        <!-- SISI KANAN: Visual BPS-Style Arch, Accents & Geophysics Data Illustration -->
        <div class="hidden lg:flex lg:w-[50%] xl:w-[55%] relative min-h-screen items-center justify-center overflow-hidden">
            
            <!-- Curved Navy Shape (#002b66) khas BPS SSO -->
            <div class="absolute inset-y-0 right-0 w-full h-full pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 700 900" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M220 0C140 180 90 350 190 520C290 690 250 820 180 900H700V0H220Z" fill="#002b66" />
                </svg>
            </div>

            <!-- Aksen Lingkaran Hijau Zamrud (#00ba70) di Atas Kurva -->
            <div class="absolute -top-10 left-[18%] xl:left-[22%] w-36 h-36 rounded-full bg-[#00ba70] shadow-xl pointer-events-none"></div>

            <!-- Aksen Lingkaran Oranye (#ea580c) di Bawah Kurva -->
            <div class="absolute bottom-6 left-[22%] xl:left-[26%] w-28 h-28 rounded-full bg-[#ea580c] shadow-lg pointer-events-none"></div>

            <!-- Komposisi Kartu & Ilustrasi Pemohon Data -->
            <div class="relative z-10 w-full max-w-xl px-6 py-12 flex flex-col items-center">
                
                <!-- Floating Card 1: Window Antarmuka Data Kebumian -->
                <div class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-2xl p-5 shadow-2xl border border-white/50 mb-6 transform -rotate-1 hover:rotate-0 transition duration-300">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-rose-400 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 inline-block"></span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Portal Pelayanan Data</span>
                    </div>

                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-slate-800">Katalog Gempabumi & Petir</p>
                                <p class="text-[10px] text-slate-500">Stasiun Geofisika Balikpapan</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                Terverifikasi
                            </span>
                        </div>

                        <!-- Waveform Graphic -->
                        <div class="h-16 w-full bg-slate-50 rounded-xl p-2 flex items-center border border-slate-100">
                            <svg class="w-full h-12 text-[#002b66]" viewBox="0 0 300 50" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M0 25 H40 L45 20 L50 30 L55 25 H80 L85 10 L90 40 L95 5 L100 45 L105 18 L110 32 L115 25 H160 L165 22 L170 28 L175 25 H220 L225 12 L230 38 L235 25 H300" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Floating Card 2 & Ilustrasi Konsultasi -->
                <div class="w-full max-w-lg flex items-end justify-between gap-4">
                    
                    <!-- Kartu Pemohon Resmi -->
                    <div class="w-48 bg-white/95 backdrop-blur-md rounded-2xl p-4 shadow-xl border border-white/50 transform translate-y-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center mx-auto mb-2 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-center text-slate-800">Pemohon Resmi</p>
                        <p class="text-[10px] text-center text-slate-500">Tarif PP RI 47/2018</p>
                        <div class="mt-3 pt-2 border-t border-slate-100 flex justify-center">
                            <span class="text-[10px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-md">
                                Layanan Cepat
                            </span>
                        </div>
                    </div>

                    <!-- Ilustrasi Dua Karakter Diskusi (Gaya Vektor Flat BPS SSO) -->
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

                            <!-- Tablet di Meja -->
                            <rect x="140" y="132" width="45" height="15" rx="3" fill="#334155" />
                            <rect x="143" y="134" width="39" height="11" rx="2" fill="#38bdf8" />
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

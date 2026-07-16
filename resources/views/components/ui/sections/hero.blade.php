<div id="hero" class="relative isolate px-6 pt-14 lg:px-8 overflow-hidden bg-white">
    <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
            class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#0ea5e9] to-[#4f46e5] opacity-20 sm:left-[calc(50%-30rem)] sm:w-288.75">
        </div>
    </div>

    <div class="mx-auto max-w-2xl py-24 sm:py-32 lg:py-40">
        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            <div
                class="relative rounded-full px-4 py-1.5 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 transition">
                <span class="font-semibold text-indigo-600">Info Layanan:</span> Kunjungan edukasi sekolah kini dibuka.
                <a href="{{ route('activity') }}" class="font-semibold text-indigo-600 ml-1">
                    <span aria-hidden="true" class="absolute inset-0"></span>Selengkapnya <span
                        aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="text-center">
            <h1 class="text-5xl font-extrabold tracking-tight text-balance text-gray-900 sm:text-7xl">
                Informasi Geofisika <br>
                <span class="text-indigo-600 inline-flex" x-data="{
                    words: ['Cepat...', 'Tepat...', 'Akurat...', 'Mudah Dipahami...'],
                    currentWordIndex: 0,
                    displayText: '',
                    isDeleting: false,
                    speed: 150,
                    type() {
                        let currentFullWord = this.words[this.currentWordIndex];
                
                        if (this.isDeleting) {
                            this.displayText = currentFullWord.substring(0, this.displayText.length - 1);
                            this.speed = 70;
                        } else {
                            this.displayText = currentFullWord.substring(0, this.displayText.length + 1);
                            this.speed = 70;
                        }
                
                        if (!this.isDeleting && this.displayText === currentFullWord) {
                            this.isDeleting = true;
                            this.speed = 1000; // Berhenti sejenak saat kata lengkap
                        } else if (this.isDeleting && this.displayText === '') {
                            this.isDeleting = false;
                            this.currentWordIndex = (this.currentWordIndex + 1) % this.words.length;
                            this.speed = 200;
                        }
                
                        setTimeout(() => this.type(), this.speed);
                    }
                }" x-init="type()">
                    <span x-text="displayText"></span>
                    <span class="ml-1 border-r-4 border-indigo-600 animate-pulse"></span>
                </span>
            </h1>
            <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                Stasiun Geofisika Balikpapan mengawal keselamatan masyarakat Kalimantan melalui monitoring
                gempabumi, petir, dan tanda waktu secara real-time 24/7.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="#monitoring"
                    class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                    Cek Gempa Terkini
                </a>
                <a href="{{ route('profil.profil') }}"
                    class="text-sm font-bold leading-6 text-gray-900 hover:text-indigo-600 transition">
                    Profil Instansi <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>

    <div aria-hidden="true"
        class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
            class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#38bdf8] to-[#6366f1] opacity-20 sm:left-[calc(50%+36rem)] sm:w-288.75">
        </div>
    </div>
</div>

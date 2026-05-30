<?php

use Livewire\Component;

new class extends Component {
    public array $videos = [];

    public function mount(): void
    {
        $this->videos = [
            [
                'title' => 'Kunjungan Edukasi Siswa SMPS Integral Luqman Al Hakim',
                'label' => 'Sorotan Kegiatan',
                'description' => 'Dokumentasi kegiatan edukasi kebencanaan bersama peserta didik di Stasiun Geofisika Balikpapan.',
                'video_id' => 'ZR13ukPdzsw',
            ],
            [
                'title' => 'Pengamatan Hilal 1 Syawal Bersama Mitra Daerah',
                'label' => 'Kegiatan UPT',
                'description' => 'Kolaborasi pengamatan hilal bersama mitra daerah dan pemangku kepentingan.',
                'video_id' => 'FYSK6vN_QFs',
            ],
            [
                'title' => 'Kunjungan Edukasi Siswa SD PJHI Balikpapan',
                'label' => 'Kegiatan UPT',
                'description' => 'Kunjungan edukatif siswa untuk mengenal pengamatan geofisika dan layanan BMKG.',
                'video_id' => '3ecqqxH7J7I',
            ],
            [
                'title' => 'Kaleidoskop Kegiatan Stasiun Geofisika Balikpapan Tahun 2025',
                'label' => 'Kegiatan UPT',
                'description' => 'Rangkuman kegiatan dan capaian Stasiun Geofisika Balikpapan sepanjang tahun 2025.',
                'video_id' => '04U6CkZXdCg',
            ],
        ];
    }

    public function render()
    {
        return view('components.geofisika.media-section');
    }
};
?>

@php
    $featuredVideo = $videos[0] ?? null;
    $supportingVideos = array_slice($videos, 1, 3);
@endphp

<section id="media-upt" class="relative isolate overflow-hidden bg-slate-950 py-14 sm:py-16">
    <x-ui.decoration.blur-bg position="top" color="from-[#0ea5e9]/15 to-[#4f46e5]/15" />

    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl mb-8">
            <p class="text-[10px] font-black uppercase tracking-[0.35em] text-indigo-600 mb-3">Media UPT</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">
                Video Kegiatan <span class="text-indigo-600">Stasiun Geofisika Balikpapan</span>
            </h2>
            <p class="mt-4 text-sm md:text-base font-medium text-slate-300 leading-relaxed">
                Kumpulan dokumentasi kegiatan, sosialisasi, dan edukasi publik yang menampilkan aktivitas UPT secara
                lebih dekat dan mudah dipahami masyarakat.
            </p>
        </div>

        @if ($featuredVideo)
            <div class="grid gap-4 lg:grid-cols-[minmax(0,0.96fr)_280px] items-stretch">
                <article class="flex h-full flex-col rounded-[1.75rem] border border-white/10 bg-white/5 p-3 md:p-4 shadow-xl backdrop-blur-sm">
                    <div class="aspect-[16/8.6] overflow-hidden rounded-[1.15rem] border border-white/10 bg-black">
                        <iframe class="h-full w-full"
                            src="https://www.youtube.com/embed/{{ $featuredVideo['video_id'] }}"
                            title="{{ $featuredVideo['title'] }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>

                    <div class="px-1 pt-4 pb-1">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600">
                            {{ $featuredVideo['label'] }}
                        </p>
                        <h3 class="mt-2 text-lg md:text-[1.35rem] font-extrabold text-white leading-snug">
                            {{ $featuredVideo['title'] }}
                        </h3>
                        <p class="mt-3 text-sm text-slate-300 leading-relaxed">
                            {{ $featuredVideo['description'] }}
                        </p>
                        <a href="https://www.youtube.com/watch?v={{ $featuredVideo['video_id'] }}" target="_blank"
                            rel="noopener noreferrer"
                            class="mt-4 inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-[11px] font-black uppercase tracking-[0.2em] text-white transition hover:bg-indigo-500">
                            Tonton di YouTube
                        </a>
                    </div>
                </article>

                <div class="grid h-full gap-3 lg:grid-rows-3">
                    @foreach ($supportingVideos as $video)
                        <article
                            class="group h-full min-h-0 overflow-hidden rounded-[1.25rem] border border-white/10 bg-white/5 shadow-sm transition hover:border-indigo-400/40 hover:bg-white/10">
                            <a href="https://www.youtube.com/watch?v={{ $video['video_id'] }}" target="_blank"
                                rel="noopener noreferrer" class="relative flex h-full items-stretch overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-black">
                                    <img src="https://i.ytimg.com/vi/{{ $video['video_id'] }}/hqdefault.jpg"
                                        alt="{{ $video['title'] }}"
                                        class="h-full w-full object-cover opacity-80 transition duration-300 group-hover:scale-105 group-hover:opacity-70">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/55 to-transparent"></div>
                                <div class="relative flex min-w-0 flex-1 flex-col justify-end p-3.5">
                                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-indigo-400">
                                        {{ $video['label'] }}
                                    </p>
                                    <h3 class="mt-1 text-sm font-extrabold text-white leading-snug line-clamp-2">
                                        {{ $video['title'] }}
                                    </h3>
                                    <p class="mt-2 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-300">
                                        Tonton di YouTube
                                    </p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

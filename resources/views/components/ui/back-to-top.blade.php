<div
    x-data="{ show: false }"
    x-init="show = window.scrollY > 300"
    @scroll.window="show = window.scrollY > 300"
    class="fixed bottom-6 right-6 z-50"
>
    <button
        type="button"
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-90"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Kembali ke atas"
        title="Kembali ke atas"
        class="flex items-center justify-center p-3 rounded-full bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 hover:shadow-indigo-500/30 active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 cursor-pointer group"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2.5"
            stroke="currentColor"
            class="w-5 h-5 transition-transform duration-200 group-hover:-translate-y-0.5"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>
</div>

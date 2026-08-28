<x-layouts.app>
    <x-slot:title>Buletin Geofisika PGR XI - Stageof Balikpapan</x-slot:title>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-8 pb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="/" class="hover:text-blue-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Publikasi</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Buletin</span>
                </div>
            </li>
        </ol>
    </div>

    <section class="py-16 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <livewire:publikasi.buletin-list />
        </div>
    </section>
</x-layouts.app>

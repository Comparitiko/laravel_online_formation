@props(['material'])

<!-- Tarjeta de recurso PDF -->
<div class="bg-slate-300 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden
border-l-4">
    <div class="flex flex-col md:flex-row">
        <!-- Icono -->
        <x-cards.components.material-icon :material="$material" />

        <!-- Contenido principal -->
        <div class="p-4 flex-grow">
            <div class="mt-4 flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex items-center text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Subido el {{ $material->created_at->format('d/m/Y') }}
                </div>

                <div class="mt-3 md:mt-0">
                    <a
                       href="{{ Storage::url($material->url) }}"
                       target="_blank"
                       class="inline-flex
                    items-center px-4
                    py-2
                    bg-red-500
                    hover:bg-red-600
                    text-white
                    text-sm font-medium rounded-md transition-colors duration-300 gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"/></svg>
                        Ver recurso
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de la parte baja -->
    <div class="h-1 w-full bg-gray-200">
        <div class="h-1 bg-green-500 w-3/4"></div>
    </div>
</div>

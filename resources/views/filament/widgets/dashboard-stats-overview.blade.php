@php
    $user = auth()->user();
    $ranks = \App\Models\Rank::all(); // Get all ranks to categorize if needed
    // Simple logic to count ranks by roman numeral if available in name, otherwise dummy
    // $rankCounts = ...
@endphp

<x-filament::widget>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex justify-between items-end mb-6">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back, {{ $user->name }}. Here's what's
                    happening today.</p>
            </div>
            <div
                class="hidden sm:block text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-[#1E293B] px-3 py-1 rounded-md shadow-sm border border-gray-200 dark:border-[#334155]">
                Today: <span class="font-medium text-gray-900 dark:text-white">{{ now()->format('M d, Y') }}</span>
            </div>
        </div>

        <!-- Info Card -->
        <div
            class="mb-8 bg-[#1E293B] rounded-lg shadow-sm p-3 flex items-start sm:items-center gap-3 border-l-4 border-[#FFC107]">
            <x-heroicon-o-megaphone class="w-6 h-6 text-[#FFC107] shrink-0 animate-pulse" />
            <p class="text-sm text-white/90 font-medium">
                <span class="font-bold text-[#FFC107] mr-1">INFO:</span>
                Bpk/Ibu {{ $user->name_with_title ?? $user->name }}, semoga selalu diberikan keselamatan, kesehatan,
                kesuksesan dan keberkahan. Amiin YRA.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Profile Card -->
            <div
                class="lg:col-span-2 bg-white dark:bg-[#1E293B] rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#E2E8F0] dark:border-[#334155] overflow-hidden flex flex-col">
                <div class="bg-gradient-to-r from-[#1E293B] to-slate-800 p-4">
                    <h2 class="text-white font-semibold flex items-center gap-2">
                        <x-heroicon-o-identification class="w-5 h-5 text-[#FFC107]" />
                        Data Pegawai
                    </h2>
                </div>
                <div class="p-6 flex flex-col sm:flex-row gap-6 items-center sm:items-start flex-1">
                    <div class="shrink-0 relative group">
                        <div
                            class="w-32 h-40 rounded-lg overflow-hidden shadow-md border-4 border-white dark:border-gray-700 bg-gray-200">
                            <img alt="User Photo" class="w-full h-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0EA5E9&color=fff" />
                        </div>
                        <div
                            class="absolute bottom-2 right-2 h-3 w-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800">
                        </div>
                    </div>
                    <div class="flex-1 w-full space-y-3">
                        <div class="border-b border-gray-100 dark:border-gray-700 pb-2">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $user->nama_cetak_dengan_gelar ?? $user->name }}</h3>
                            <p class="text-sm text-[#FFC107] font-medium">NIP. {{ $user->nip ?? '-' }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                            <div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase">Pangkat / Golongan</p>
                                <p class="font-medium text-gray-700 dark:text-gray-300">{{ $user->rank->name ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase">Unit Kerja</p>
                                <p class="font-medium text-gray-700 dark:text-gray-300">
                                    {{ $user->workUnit->name ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase">Email</p>
                                <p class="font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
                                    <x-heroicon-o-envelope class="w-4 h-4" />
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-800/50 px-6 py-3 border-t border-[#E2E8F0] dark:border-[#334155] flex justify-end">
                    <button
                        class="text-xs font-semibold text-[#0EA5E9] hover:text-blue-700 dark:hover:text-blue-400 flex items-center gap-1 transition-colors">
                        VIEW FULL PROFILE <x-heroicon-m-arrow-right class="w-4 h-4" />
                    </button>
                </div>
            </div>

            <!-- Status Cuti Card -->
            <div
                class="bg-white dark:bg-[#1E293B] rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#E2E8F0] dark:border-[#334155] overflow-hidden flex flex-col h-full">
                <div class="bg-[#0EA5E9] p-4 flex justify-between items-center">
                    <h2 class="text-white font-semibold flex items-center gap-2">
                        <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />
                        Status Cuti
                    </h2>
                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded">{{ now()->year }}</span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-center">
                    <div class="space-y-4">
                        <div
                            class="flex justify-between items-center border-b border-dashed border-gray-200 dark:border-gray-700 pb-3">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Hak Cuti Tahunan</span>
                            <span class="font-bold text-gray-800 dark:text-white">12 + 1 Hari</span>
                        </div>
                        <div
                            class="flex justify-between items-center border-b border-dashed border-gray-200 dark:border-gray-700 pb-3">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Pengambilan</span>
                            <span class="font-bold text-red-500">0 Hari</span>
                        </div>
                        <div class="flex justify-between items-center pt-1">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Sisa Cuti</span>
                            <span class="text-2xl font-bold text-[#0EA5E9]">13 <span
                                    class="text-sm font-normal text-gray-500">Hari</span></span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <button
                        class="w-full bg-[#0EA5E9] hover:bg-sky-600 text-white font-medium py-2 rounded-lg transition-colors flex justify-center items-center gap-2 shadow-md">
                        <x-heroicon-o-plus-circle class="w-5 h-5" />
                        Ajukan Cuti
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Indeks Profesionalitas ASN -->
            <div
                class="xl:col-span-2 bg-white dark:bg-[#1E293B] rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#E2E8F0] dark:border-[#334155] p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <x-heroicon-o-chart-bar class="w-6 h-6 text-[#1E293B] dark:text-gray-300" />
                        Indeks Profesionalitas ASN
                    </h3>
                    <div class="flex bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
                        <button
                            class="px-4 py-1 text-xs font-medium bg-white dark:bg-gray-700 text-[#FFC107] shadow-sm rounded-md">PERSONAL</button>
                        <button
                            class="px-4 py-1 text-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">LEMBAGA</button>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-8 items-center">
                    <div class="grid grid-cols-2 gap-4 w-full lg:w-2/3">
                        @foreach ([['label' => 'Kualifikasi', 'value' => 20], ['label' => 'Kompetensi', 'value' => 0], ['label' => 'Kinerja', 'value' => 0], ['label' => 'Disiplin', 'value' => 5]] as $item)
                            <div
                                class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-green-600 mb-1">{{ $item['value'] }}</div>
                                    <div
                                        class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                        {{ $item['label'] }}</div>
                                    <a href="#"
                                        class="mt-2 text-[10px] text-[#0EA5E9] flex justify-center items-center gap-0.5 hover:underline">
                                        More info <x-heroicon-m-arrow-right class="w-3 h-3" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="w-full lg:w-1/3 flex flex-col items-center justify-center border-t lg:border-t-0 lg:border-l border-dashed border-gray-200 dark:border-gray-700 pt-6 lg:pt-0 lg:pl-6">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-4">NILAI IP-ASN</p>
                        <div class="relative w-32 h-32 flex items-center justify-center">
                            <!-- Simple SVG Gauge -->
                            <svg class="w-full h-full" viewBox="0 0 36 36">
                                <path class="text-gray-100 dark:text-gray-700"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none" stroke="currentColor" stroke-width="3"></path>
                                <path class="text-red-500"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none" stroke="currentColor" stroke-dasharray="25, 100" stroke-width="3">
                                </path>
                            </svg>
                            <span class="absolute text-4xl font-black text-gray-800 dark:text-white">25</span>
                        </div>
                        <span
                            class="mt-4 px-4 py-1 bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 text-xs font-bold rounded-full uppercase tracking-wider">Rendah</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Satker -->
            <div
                class="bg-white dark:bg-[#1E293B] rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#E2E8F0] dark:border-[#334155] flex flex-col h-full overflow-hidden">
                <div class="bg-[#FFC107] p-4">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        <x-heroicon-o-information-circle class="w-5 h-5 text-gray-900" />
                        INFORMASI SATKER
                    </h3>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar h-[340px]">
                    <!-- Jumlah Pegawai -->
                    <div
                        class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700 group">
                        <div
                            class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center shrink-0 text-blue-600 dark:text-blue-400">
                            <x-heroicon-o-users class="w-6 h-6" />
                        </div>
                        <div>
                            <h4
                                class="font-bold text-[#0EA5E9] text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Jumlah Pegawai</h4>
                            <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">Total <span
                                    class="font-semibold text-gray-700 dark:text-gray-200">{{ \App\Models\User::count() }}</span>
                                (PNS:
                                {{ \App\Models\User::whereHas('asnType', function ($q) {$q->where('name', 'PNS');})->count() }})
                            </p>
                        </div>
                    </div>

                    <!-- Pegawai Satker/UK -->
                    <div
                        class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700 group">
                        <div
                            class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center shrink-0 text-indigo-600 dark:text-indigo-400">
                            <x-heroicon-o-building-office-2 class="w-6 h-6" />
                        </div>
                        <div>
                            <h4
                                class="font-bold text-[#0EA5E9] text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Pegawai Unit Kerja</h4>
                            <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">
                                @foreach (\App\Models\WorkUnit::withCount('users')->orderByDesc('users_count')->take(3)->get() as $unit)
                                    {{ $unit->code ?? substr($unit->name, 0, 10) }}
                                    ({{ $unit->users_count }})
                                    {{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <!-- Golongan -->
                    <div
                        class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700 group">
                        <div
                            class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center shrink-0 text-purple-600 dark:text-purple-400">
                            <x-heroicon-o-scale class="w-6 h-6" />
                        </div>
                        <div>
                            <h4
                                class="font-bold text-[#0EA5E9] text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Golongan (Sample Data)</h4>
                            <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">IV (126), III (283), II (22), I
                                (0)</p>
                        </div>
                    </div>

                    <!-- Pendidikan -->
                    <div
                        class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700 group">
                        <div
                            class="h-10 w-10 rounded-full bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                            <x-heroicon-o-academic-cap class="w-6 h-6" />
                        </div>
                        <div>
                            <h4
                                class="font-bold text-[#0EA5E9] text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Pendidikan (Sample Data)</h4>
                            <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">S-3 (18), S-2 (143), S-1 (176),
                                D4-1 (67)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer
            class="mt-8 border-t border-[#E2E8F0] dark:border-[#334155] pt-6 pb-2 text-center text-xs text-gray-400">
            <p>© {{ now()->year }} SIMKA BAPETEN. All rights reserved. System Version 4.0</p>
        </footer>
    </div>
</x-filament::widget>

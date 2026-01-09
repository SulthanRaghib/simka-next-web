<x-filament-panels::page>
    @php
        $employee = $record;

        // Mock Data Structure (mimicking React state)
        // In a real app, these would come from the User model relations
        $userModules = [
            [
                'id' => 'master',
                'title' => 'Master Data',
                'description' => 'Personal & administrative details',
                'icon' => '📋',
                'status' => 'Complete',
                'metadata' => 'Last updated: 15 Dec 2024',
            ],
            [
                'id' => 'biodata',
                'title' => 'Biodata',
                'description' => 'Personal information & family',
                'icon' => '👤',
                'status' => 'Complete',
                'metadata' => 'Last updated: 12 Jun 2024',
            ],
            [
                'id' => 'employment',
                'title' => 'Kepegawaian',
                'description' => 'Employment & position history',
                'icon' => '💼',
                'status' => 'Active',
                'metadata' => 'Current rank: ' . ($employee->rank->name ?? '-'),
            ],
            [
                'id' => 'education',
                'title' => 'Pendidikan',
                'description' => 'Education & training records',
                'icon' => '🎓',
                'status' => 'Complete',
                'metadata' => 'Latest: S1 (2019)',
            ],
            [
                'id' => 'publications',
                'title' => 'Publikasi',
                'description' => 'Published works & research',
                'icon' => '📚',
                'status' => 'No Data',
                'metadata' => 'No publications recorded',
            ],
            [
                'id' => 'leave',
                'title' => 'Cuti & Izin',
                'description' => 'Leave & permission records',
                'icon' => '📅',
                'status' => 'Incomplete',
                'metadata' => '2024: 8 days used',
            ],
            [
                'id' => 'dp3',
                'title' => 'DP3',
                'description' => 'Performance appraisal results',
                'icon' => '⭐',
                'status' => 'Draft',
                'metadata' => '2025 pending submission',
            ],
            [
                'id' => 'inspection',
                'title' => 'Riwayat Inspeksi',
                'description' => 'Inspection history',
                'icon' => '🔍',
                'status' => 'Complete',
                'metadata' => 'Last: 28 Oct 2024',
            ],
            [
                'id' => 'skp',
                'title' => 'SKP',
                'description' => 'Performance targets & results',
                'icon' => '📊',
                'status' => 'Complete',
                'metadata' => '2024: 95% achievement',
            ],
        ];

        // Mock Detail Data
        $moduleData = [
            'master' => [
                'sections' => [
                    [
                        'title' => 'Data Pangkat dan Golongan',
                        'type' => 'table',
                        'columns' => ['No', 'Status', 'Pangkat/Gol.', 'TMT', 'Jenis KP', 'Masa Kerja', 'No/Tgl SK'],
                        'rows' => [
                            [
                                '1',
                                'PNS',
                                'Penata Muda Tk. I (III/b)',
                                '01-10-2024',
                                'Pilihan JF',
                                '3 th. 8 bln.',
                                'SK-001/2024',
                            ],
                            ['2', 'PNS', 'Penata Muda (III/a)', '01-04-2022', 'Reguler', '1 th. 2 bln.', 'SK-002/2022'],
                        ],
                    ],
                ],
            ],
            'education' => [
                'sections' => [
                    [
                        'title' => 'Pendidikan Formal',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Jenjang',
                            'Lembaga Pendidikan',
                            'Kota/Negara',
                            'Jurusan',
                            'Masuk',
                            'Lulus',
                        ],
                        'rows' => [
                            [
                                '1',
                                'S-1',
                                'Universitas Padjadjaran',
                                'Bandung/Indonesia',
                                'Administrasi Bisnis',
                                '2014',
                                '2019',
                            ],
                        ],
                    ],
                ],
            ],
            'biodata' => [
                'sections' => [
                    [
                        'title' => 'Informasi Personal',
                        'type' => 'info',
                        'fields' => [
                            ['Tempat Lahir', 'Bandung'],
                            ['Tanggal Lahir', '12-03-1975'],
                            ['Jenis Kelamin', 'Laki-laki'],
                            ['Agama', 'Islam'],
                            ['Status Perkawinan', 'Kawin'],
                            ['Email', $employee->email],
                        ],
                    ],
                ],
            ],
            'employment' => [
                'sections' => [
                    [
                        'title' => 'Riwayat Jabatan',
                        'type' => 'table',
                        'columns' => ['No', 'Nama Jabatan', 'Unit Kerja', 'TMT', 'Status'],
                        'rows' => [
                            [
                                '1',
                                $employee->jobPosition->name ?? '-',
                                $employee->workUnit->name ?? '-',
                                '01-01-2024',
                                'Aktif',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    @endphp

    <div x-data="{
        selectedModule: null,
        scrollProgress: 0,
        showLeftArrow: false,
        showRightArrow: true,
    
        selectModule(id) {
            this.selectedModule = id;
        },
    
        scroll(direction) {
            const container = this.$refs.scrollContainer;
            const scrollAmount = 300;
            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        },
    
        handleScroll() {
            const container = this.$refs.scrollContainer;
            if (!container) return;
    
            const { scrollLeft, scrollWidth, clientWidth } = container;
            this.showLeftArrow = scrollLeft > 0;
            this.showRightArrow = scrollLeft < scrollWidth - clientWidth - 10;
            this.scrollProgress = (scrollLeft / (scrollWidth - clientWidth)) * 100;
        }
    }" x-init="handleScroll()" class="space-y-8">

        <!-- Employee Header -->
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            <div class="flex flex-col gap-6 p-6 sm:flex-row sm:gap-8">
                <!-- Photo -->
                <div class="shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=0EA5E9&color=fff&size=256"
                        alt="{{ $employee->name }}"
                        class="h-40 w-40 rounded-lg object-cover ring-2 ring-primary-500/10 dark:ring-primary-400/20">
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $employee->name }}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Employee Profile</p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                NIP</p>
                            <p class="text-sm font-mono text-gray-900 dark:text-gray-200">{{ $employee->nip ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Pangkat/Golongan</p>
                            <p class="text-sm text-gray-900 dark:text-gray-200">{{ $employee->rank->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Jabatan</p>
                            <p class="text-sm text-gray-900 dark:text-gray-200">
                                {{ $employee->jobPosition->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Status Pegawai</p>
                            <p class="text-sm text-gray-900 dark:text-gray-200">
                                {{ $employee->employmentStatus->name ?? '-' }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Unit Kerja</p>
                            <p class="text-sm text-gray-900 dark:text-gray-200">{{ $employee->workUnit->name ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <span
                            class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modules Section -->
        <div>
            <h2 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">Profile Modules</h2>

            <!-- Module Grid / Carousel -->
            <div class="space-y-3 relative group">
                <!-- Navigation Arrows -->
                <button x-show="showLeftArrow" @click="scroll('left')"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-all focus:outline-none border border-gray-100 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                    <x-heroicon-m-chevron-left class="w-5 h-5" />
                </button>

                <button x-show="showRightArrow" @click="scroll('right')"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-all focus:outline-none border border-gray-100 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                    <x-heroicon-m-chevron-right class="w-5 h-5" />
                </button>

                <!-- Gradient Fades -->
                <div x-show="showLeftArrow"
                    class="pointer-events-none absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-gray-50 dark:from-gray-950 to-transparent z-10">
                </div>
                <div x-show="showRightArrow"
                    class="pointer-events-none absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-gray-50 dark:from-gray-950 to-transparent z-10">
                </div>

                <!-- Scroll Container -->
                <div x-ref="scrollContainer" @scroll.debounce.10ms="handleScroll()"
                    class="flex gap-4 overflow-x-auto pb-4 scroll-smooth snap-x snap-mandatory no-scrollbar"
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach ($userModules as $module)
                        <div @click="selectModule('{{ $module['id'] }}')"
                            class="flex-shrink-0 snap-start cursor-pointer transition-all duration-200 w-72">
                            <div :class="selectedModule === '{{ $module['id'] }}'
                                ?
                                'border-2 border-primary-500 bg-primary-50 dark:bg-primary-900/10 shadow-md transform scale-[1.02]' :
                                'border border-gray-200 dark:border-gray-800 hover:border-primary-500/50 hover:shadow-sm bg-white dark:bg-gray-900'"
                                class="h-full p-4 rounded-xl transition-all flex flex-col justify-between">
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <div class="text-2xl shrink-0">{{ $module['icon'] }}</div>
                                        <div class="min-w-0">
                                            <h3
                                                class="font-semibold text-gray-900 dark:text-white text-sm leading-tight">
                                                {{ $module['title'] }}</h3>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                                {{ $module['description'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-800 space-y-2">
                                    <span
                                        class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-medium
                                        {{ $module['status'] === 'Complete'
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                            : ($module['status'] === 'Active'
                                                ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'
                                                : ($module['status'] === 'Incomplete'
                                                    ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400'
                                                    : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400')) }}">
                                        {{ $module['status'] }}
                                    </span>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-500 line-clamp-1">
                                        {{ $module['metadata'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Scroll Progress Bar -->
            <div class="h-1 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden mt-2">
                <div class="h-full bg-primary-500 transition-all duration-300"
                    :style="'width: ' + scrollProgress + '%'"></div>
            </div>
        </div>

        <!-- Module Detail View -->
        <template x-if="selectedModule">
            <div class="animate-in fade-in slide-in-from-top-4 duration-500 ease-out">
                @foreach ($userModules as $module)
                    <template x-if="selectedModule === '{{ $module['id'] }}'">
                        <div class="space-y-6">
                            <!-- Module Header -->
                            <div
                                class="flex items-center gap-4 p-6 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">
                                <div class="text-4xl shrink-0">{{ $module['icon'] }}</div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $module['title'] }}
                                    </h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $module['description'] }}
                                    </p>
                                </div>
                            </div>

                            <!-- Dynamic Sections -->
                            @if (isset($moduleData[$module['id']]))
                                @foreach ($moduleData[$module['id']]['sections'] as $section)
                                    <div
                                        class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                                        <h3
                                            class="mb-4 text-base font-semibold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-800 pb-3">
                                            {{ $section['title'] }}
                                        </h3>

                                        @if ($section['type'] === 'table')
                                            <div class="overflow-x-auto">
                                                <table class="w-full text-sm text-left">
                                                    <thead
                                                        class="text-xs text-gray-500 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-800/50">
                                                        <tr>
                                                            @foreach ($section['columns'] as $col)
                                                                <th class="px-4 py-3 font-semibold">{{ $col }}
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                                        @foreach ($section['rows'] as $row)
                                                            <tr
                                                                class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                                                @foreach ($row as $cell)
                                                                    <td
                                                                        class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                                                        {{ $cell }}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @elseif($section['type'] === 'info')
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                @foreach ($section['fields'] as $field)
                                                    <div class="flex flex-col">
                                                        <span
                                                            class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $field[0] }}</span>
                                                        <span
                                                            class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $field[1] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div
                                    class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm p-12 text-center">
                                    <div class="text-gray-400 mb-2">
                                        <x-heroicon-o-inbox class="w-12 h-12 mx-auto" />
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400">No detailed data available for this
                                        module yet.</p>
                                </div>
                            @endif
                        </div>
                    </template>
                @endforeach
            </div>
        </template>

        <template x-if="!selectedModule">
            <div
                class="bg-gray-50 dark:bg-gray-800/30 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl p-12 text-center">
                <p class="text-gray-500 dark:text-gray-400 text-sm">Select a module above to view details</p>
            </div>
        </template>
    </div>
</x-filament-panels::page>

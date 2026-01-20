<x-filament-panels::page>
    @php
        $employee = $record;

        // Fetching Real Data from the Model
        $familyMembers = $employee->familyMembers;
        $hobbies = $employee->hobbies;
        $medicalRecords = $employee->medicalRecords;
        $insurances = $employee->insurances;

        // Employment Data
        $rankHistories = $employee->rankHistories;
        $structuralPositions = $employee->structuralPositions;
        $functionalPositions = $employee->functionalPositions;
        $otherPositions = $employee->otherPositions;
        $salaryIncreases = $employee->salaryIncreases;
        $performanceAppraisals = $employee->performanceAppraisals;
        $awards = $employee->awards;

        // Dynamic Status Helpers
        $biodataStatus = $familyMembers->isNotEmpty() || $hobbies->isNotEmpty() ? 'Active' : 'Incomplete';
        $healthStatus = $medicalRecords->isNotEmpty() || $insurances->isNotEmpty() ? 'Active' : 'No Data';
        $employmentStatus =
            $rankHistories->isNotEmpty() || $structuralPositions->isNotEmpty() ? 'Active' : 'Incomplete';
        $performanceStatus = $performanceAppraisals->isNotEmpty() ? 'Active' : 'No Data';
        $awardsStatus = $awards->isNotEmpty() ? 'Complete' : 'No Data';

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
                'status' => $biodataStatus,
                'metadata' => $familyMembers->count() . ' family members',
            ],
            [
                'id' => 'kesehatan',
                'title' => 'Kesehatan & Asuransi',
                'description' => 'Medical history & insurance',
                'icon' => '🏥',
                'status' => $healthStatus,
                'metadata' => $medicalRecords->count() . ' records',
            ],
            [
                'id' => 'employment',
                'title' => 'Kepegawaian',
                'description' => 'Employment & position history',
                'icon' => '💼',
                'status' => $employmentStatus,
                'metadata' => $rankHistories->count() . ' rank records',
            ],
            [
                'id' => 'performance',
                'title' => 'Penilaian & Penghargaan',
                'description' => 'Performance appraisals & awards',
                'icon' => '⭐',
                'status' => $performanceStatus,
                'metadata' => $performanceAppraisals->count() . ' appraisals, ' . $awards->count() . ' awards',
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

        // Prepare Table Rows
        $familyRows = $familyMembers->map(
            fn($item, $index) => [
                $index + 1,
                $item->relationship,
                $item->name,
                $item->gender === 'L' ? 'Laki-laki' : 'Perempuan',
                $item->date_of_birth ? \Carbon\Carbon::parse($item->date_of_birth)->translatedFormat('d F Y') : '-',
                $item->education ?? '-',
                $item->occupation ?? '-',
            ],
        );

        $hobbyRows = $hobbies->map(fn($item, $index) => [$index + 1, $item->name, $item->notes ?? '-']);

        $medicalRows = $medicalRecords->map(
            fn($item, $index) => [
                $index + 1,
                \Carbon\Carbon::parse($item->checkup_date)->translatedFormat('d F Y'),
                $item->location,
                $item->result,
                \Illuminate\Support\Str::limit($item->health_resume, 50) ?? '-',
            ],
        );

        $insuranceRows = $insurances->map(
            fn($item, $index) => [
                $index + 1,
                $item->name,
                $item->member_number,
                $item->policy_number,
                \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y'),
            ],
        );

        // Employment Table Rows
        $rankHistoryRows = $rankHistories->map(
            fn($item, $index) => [
                $index + 1,
                $item->status,
                $item->rank_grade,
                \Carbon\Carbon::parse($item->effective_date)->translatedFormat('d F Y'),
                $item->promotion_type,
                $item->service_period ?? '-',
                ($item->decree_number ?? '-') .
                ' / ' .
                (\Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y') ?? '-'),
                $item->notes ?? '-',
            ],
        );

        $structuralPositionRows = $structuralPositions->map(
            fn($item, $index) => [
                $index + 1,
                $item->position_name,
                $item->work_unit,
                \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') .
                ($item->end_date
                    ? ' - ' . \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y')
                    : ' - Sekarang'),
                ($item->decree_number ?? '-') .
                ' / ' .
                (\Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y') ?? '-'),
                $item->echelon ?? '-',
            ],
        );

        $functionalPositionRows = $functionalPositions->map(
            fn($item, $index) => [
                $index + 1,
                $item->jft_name,
                $item->agency_subminkal,
                $item->level_grade,
                \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') .
                ($item->end_date
                    ? ' - ' . \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y')
                    : ' - Sekarang'),
                ($item->decree_number ?? '-') .
                ' / ' .
                (\Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y') ?? '-'),
                $item->credit_score ?? '-',
                $item->status ?? '-',
                $item->notes ?? '-',
            ],
        );

        $otherPositionRows = $otherPositions->map(
            fn($item, $index) => [
                $index + 1,
                $item->position_name,
                $item->agency,
                \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') .
                ($item->end_date
                    ? ' - ' . \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y')
                    : ' - Sekarang'),
                ($item->decree_number ?? '-') .
                ' / ' .
                (\Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y') ?? '-'),
                $item->notes ?? '-',
            ],
        );

        $salaryIncreaseRows = $salaryIncreases->map(
            fn($item, $index) => [
                $index + 1,
                $item->decree_number,
                \Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y'),
                $item->grade,
                $item->service_period ?? '-',
                'Rp ' . number_format($item->salary_amount, 0, ',', '.'),
                \Carbon\Carbon::parse($item->effective_date)->translatedFormat('d F Y'),
            ],
        );

        $performanceAppraisalRows = $performanceAppraisals->map(
            fn($item, $index) => [
                $index + 1,
                $item->year,
                $item->loyalty_score,
                $item->achievement_score,
                $item->responsibility_score,
                $item->obedience_score,
                $item->honesty_score,
                $item->cooperation_score,
                $item->initiative_score,
                $item->leadership_score,
                $item->total_score,
                $item->rating,
            ],
        );

        $awardRows = $awards->map(
            fn($item, $index) => [
                $index + 1,
                $item->award_name,
                $item->year,
                $item->decree_number ?? '-',
                $item->decree_date ? \Carbon\Carbon::parse($item->decree_date)->translatedFormat('d F Y') : '-',
                $item->awarding_body,
                $item->notes ?? '-',
            ],
        );

        // Module Data
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
                            ['Tempat Lahir', 'Bandung'], // Placeholder as these fields are not in User model yet
                            ['Tanggal Lahir', '12-03-1975'], // Placeholder
                            ['Jenis Kelamin', 'Laki-laki'], // Placeholder
                            ['Agama', 'Islam'], // Placeholder
                            ['Status Perkawinan', 'Kawin'], // Placeholder
                            ['Email', $employee->email],
                        ],
                    ],
                    // New Sections populated from Relation Managers
                    [
                        'title' => 'Data Keluarga',
                        'type' => 'table',
                        'columns' => ['No', 'Hubungan', 'Nama', 'L/P', 'Tgl Lahir', 'Pendidikan', 'Pekerjaan'],
                        'rows' => $familyRows->toArray(),
                    ],
                    [
                        'title' => 'Hobi & Minat',
                        'type' => 'table',
                        'columns' => ['No', 'Nama Hobi', 'Keterangan'],
                        'rows' => $hobbyRows->toArray(),
                    ],
                ],
            ],
            'kesehatan' => [
                'sections' => [
                    [
                        'title' => 'Riwayat Kesehatan',
                        'type' => 'table',
                        'columns' => ['No', 'Tanggal', 'Lokasi', 'Hasil', 'Resume'],
                        'rows' => $medicalRows->toArray(),
                    ],
                    [
                        'title' => 'Data Asuransi',
                        'type' => 'table',
                        'columns' => ['No', 'Nama Asuransi', 'No. Peserta', 'No. Polis', 'Tgl Mulai'],
                        'rows' => $insuranceRows->toArray(),
                    ],
                ],
            ],
            'employment' => [
                'sections' => [
                    [
                        'title' => 'Data Pangkat dan Golongan',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Status',
                            'Pangkat/Gol.',
                            'TMT',
                            'Jenis KP',
                            'Masa Kerja',
                            'No/Tgl SK',
                            'Keterangan',
                        ],
                        'rows' => $rankHistoryRows->toArray(),
                    ],
                    [
                        'title' => 'Data Jabatan Struktural',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Nama Jabatan',
                            'Unit Kerja / Instansi',
                            'TMT Mulai/Selesai',
                            'No SK / Tanggal',
                            'Eselon',
                        ],
                        'rows' => $structuralPositionRows->toArray(),
                    ],
                    [
                        'title' => 'Data Jabatan Fungsional Tertentu',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Nama JFT',
                            'Instansi Subminkal',
                            'Jenjang/Gol',
                            'TMT Mulai/Selesai',
                            'No SK / Tanggal',
                            'Angka Kredit',
                            'Status',
                            'Keterangan',
                        ],
                        'rows' => $functionalPositionRows->toArray(),
                    ],
                    [
                        'title' => 'Data Jabatan Lainnya',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Nama Jabatan',
                            'Instansi',
                            'TMT Mulai/Selesai',
                            'No SK / Tanggal',
                            'Keterangan',
                        ],
                        'rows' => $otherPositionRows->toArray(),
                    ],
                    [
                        'title' => 'Data Kenaikan Gaji Berkala (KGB)',
                        'type' => 'table',
                        'columns' => ['No', 'Nomor SK', 'Tgl SK', 'Gol.', 'Masa Kerja', 'Besaran Gaji', 'TMT Gaji'],
                        'rows' => $salaryIncreaseRows->toArray(),
                    ],
                ],
            ],
            'performance' => [
                'sections' => [
                    [
                        'title' => 'Data DP3',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Tahun',
                            'Kesetiaan',
                            'Prestasi Kerja',
                            'Tanggung Jawab',
                            'Ketaatan',
                            'Kejujuran',
                            'Kerjasama',
                            'Prakarsa',
                            'Kepemimpinan',
                            'Total Nilai',
                            'Sebutan',
                        ],
                        'rows' => $performanceAppraisalRows->toArray(),
                    ],
                    [
                        'title' => 'Penghargaan dan Tanda Jasa',
                        'type' => 'table',
                        'columns' => [
                            'No',
                            'Nama Penghargaan',
                            'Tahun',
                            'Nomor SK',
                            'Tanggal SK',
                            'Pemberi Pengharagaan',
                            'Keterangan',
                        ],
                        'rows' => $awardRows->toArray(),
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
        {{-- Tugas & Fungsi Jabatan card: ringkasan yang dapat dikelola --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 mt-0">
                        <div
                            class="h-11 w-11 flex items-center justify-center rounded-lg bg-primary-50 text-primary-600 dark:bg-primary-900/10 dark:text-primary-300">
                            <svg class="w-5 h-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6M9 16h6M9 8h6M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tugas & Fungsi Jabatan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ringkasan tugas utama untuk posisi saat
                            ini — tampilkan tugas teratas dan kelola lebih lanjut di halaman edit.</p>
                        <div class="mt-2 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                            <span class="inline-flex items-center gap-2">
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $employee->positionDuties->count() }}</span>
                                tugas terdaftar
                            </span>
                            <span class="text-muted">•</span>
                            <span>Terakhir diperbarui:
                                {{ $employee->positionDuties->max('updated_at') ? \Carbon\Carbon::parse($employee->positionDuties->max('updated_at'))->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    @can('update', $employee)
                        <a href="{{ \App\Filament\Resources\Users\UserResource::getUrl('edit', ['record' => $employee->nip ?? $employee->id]) }}?relation=4#position-duties-relation-manager"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded bg-primary-500 text-white text-sm shadow-sm hover:bg-primary-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15.232 5.232l3.536 3.536M4 20h4.586a1 1 0 00.707-.293l9.414-9.414a1 1 0 000-1.414L15.414 4.293a1 1 0 00-1.414 0L4 14.293V20z" />
                            </svg>
                            Kelola
                        </a>
                    @endcan

                    @can('create', \App\Models\PositionDuty::class)
                        <a href="{{ \App\Filament\Resources\Users\UserResource::getUrl('edit', ['record' => $employee->nip ?? $employee->id]) }}?relation=4&action=create#position-duties-relation-manager"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded border border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 5v14M5 12h14" />
                            </svg>
                            Tambah
                        </a>
                    @endcan
                </div>
            </div>

            <div class="mt-5 grid gap-3">
                @forelse($employee->positionDuties->take(5) as $duty)
                    <article
                        class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-900">
                        <div class="flex-shrink-0">
                            <div
                                class="h-8 w-8 rounded-lg flex items-center justify-center bg-primary-600 text-white font-semibold">
                                {{ $loop->iteration }}</div>
                        </div>

                        <div class="min-w-0">
                            <div class="flex items-center justify-between gap-3">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ $duty->title }}</h4>
                                <span
                                    class="text-xs text-gray-500 dark:text-gray-400">{{ $duty->position_type ?? '-' }}</span>
                            </div>
                            @if ($duty->description)
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 line-clamp-3"
                                    title="{{ strip_tags($duty->description) }}">{!! \Illuminate\Support\Str::limit(strip_tags($duty->description), 220) !!}</p>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tidak ada deskripsi.</p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div
                        class="flex flex-col items-start gap-3 p-4 rounded-lg border border-dashed border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Belum ada tugas terdaftar.</div>
                        <div class="text-sm text-gray-500">Tambahkan tugas baru untuk posisi ini agar ringkasan lebih
                            informatif.</div>
                        <div class="mt-2">
                            @can('create', \App\Models\PositionDuty::class)
                                <a href="{{ \App\Filament\Resources\Users\UserResource::getUrl('edit', ['record' => $employee->nip ?? $employee->id]) }}?relation=4&action=create#position-duties-relation-manager"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded bg-primary-500 text-white text-sm">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 5v14M5 12h14" />
                                    </svg>
                                    Tambah Tugas
                                </a>
                            @endcan
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

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
                                                                <th class="px-4 py-3 font-semibold">
                                                                    {{ $col }}
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

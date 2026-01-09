<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'nama_cetak_tanpa_gelar',
        'nama_cetak_dengan_gelar',
        'work_unit_id',
        'job_position_id',
        'struktural_position_id',
        'pangkat_golongan_id',
        'tmt_golongan',
        'jenis_asn_id',
        'jenis_jab_id',
        'employment_status_id',
        'phone_number',
        'address',
        'birth_place',
        'birth_date',
        'gender',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'birth_date' => 'date',
            'tmt_golongan' => 'date',
        ];
    }

    public function workUnit(): BelongsTo
    {
        return $this->belongsTo(WorkUnit::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'pangkat_golongan_id');
    }

    public function asnType(): BelongsTo
    {
        return $this->belongsTo(AsnType::class, 'jenis_asn_id');
    }

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'jenis_jab_id');
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class, 'employment_status_id');
    }

    public function structuralPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'struktural_position_id');
    }
}

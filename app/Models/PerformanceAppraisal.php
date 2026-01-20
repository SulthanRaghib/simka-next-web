<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceAppraisal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'loyalty_score',
        'achievement_score',
        'responsibility_score',
        'obedience_score',
        'honesty_score',
        'cooperation_score',
        'initiative_score',
        'leadership_score',
        'total_score',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

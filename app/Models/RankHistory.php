<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankHistory extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'rank_grade',
        'effective_date',
        'promotion_type',
        'service_period',
        'decree_number',
        'decree_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

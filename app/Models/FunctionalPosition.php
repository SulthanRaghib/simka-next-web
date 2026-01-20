<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionalPosition extends Model
{
    protected $fillable = [
        'user_id',
        'jft_name',
        'agency_subminkal',
        'level_grade',
        'start_date',
        'end_date',
        'decree_number',
        'decree_date',
        'creadit_score',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

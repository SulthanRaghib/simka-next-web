<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'user_id',
        'award_name',
        'year',
        'decree_number',
        'decree_date',
        'awarding_body',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherPosition extends Model
{
    protected $fillable = [
        'user_id',
        'position_name',
        'agency',
        'start_date',
        'end_date',
        'decree_number',
        'decree_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

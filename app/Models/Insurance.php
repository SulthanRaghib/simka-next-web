<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'policy_number',
        'member_number',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

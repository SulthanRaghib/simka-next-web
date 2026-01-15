<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'user_id',
        'checkup_date',
        'location',
        'result',
        'health_resume',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

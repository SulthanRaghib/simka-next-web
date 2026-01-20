<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryIncrease extends Model
{

    protected $fillable = [
        'user_id',
        'decree_number',
        'decree_date',
        'grade',
        'service_period',
        'salary_amount',
        'effective_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

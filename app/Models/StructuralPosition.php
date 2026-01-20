<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructuralPosition extends Model
{

    protected $fillable = [
        'user_id',
        'position_name',
        'work_unit',
        'start_date',
        'end_date',
        'decree_number',
        'decree_date',
        'echelon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

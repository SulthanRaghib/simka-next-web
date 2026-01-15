<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'user_id',
        'relationship',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'education',
        'major',
        'occupation',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

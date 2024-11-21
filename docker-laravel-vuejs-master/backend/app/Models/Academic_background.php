<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_background extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'institution',
        'course',
        'education_level',
        'start_date',
        'completion_date'
    ];

    protected $casts = [
        'institution' => 'string',
        'course' => 'string',
        'education_level' => 'string',
        'start_date' => 'date',
        'completion_date' => 'date'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional_experiences extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'position',
        'description',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'company_name' => 'string',
        'position' => 'string',
        'description' => 'string',
        'start_date'=> 'date',
        'end_date' => 'date',
    ];
}

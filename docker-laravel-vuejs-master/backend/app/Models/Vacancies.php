<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_name',
        'description',
        'requirements',
        'location',
        'work_modality',
        'creation_date',
        'company'
    ];

    protected $casts = [
        'vacancy_name' => 'string',
        'description' => 'string',
        'requirements' => 'string',
        'location' => 'string',
        'work_modality' => 'string',
        'creation_date' => 'date',
        'company' => 'string',
    ];
}

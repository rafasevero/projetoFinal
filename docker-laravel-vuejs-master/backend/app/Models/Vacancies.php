<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'company',
        'salary',
        'company_logo',
        'recruiter_id',
    ];

    protected $casts = [
        'vacancy_name' => 'string',
        'description' => 'string',
        'requirements' => 'string',
        'location' => 'string',
        'work_modality' => 'string',
        'creation_date' => 'date',
        'company' => 'string',
        'salary' => 'string',
        'company_logo' => 'string',
        'recruiter_id' => 'integer',

    ];

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Recruiter::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Vacancies extends Authenticatable
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
        'min_age'
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
        'min_age' => 'integer'

    ];

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Recruiter::class);
    }


    public function applications()
    {
        return $this->hasMany(Application::class);
    }


}

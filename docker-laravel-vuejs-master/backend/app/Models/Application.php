<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Application extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_application', 'application_id', 'user_id')
                    ->withTimestamps();
    }


    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancies::class, 'vacancy_id');
    }

    protected $fillable = [
        'vacancy_id',
        'user_id',
        'recruiter_id',
        'application_date',
        'status',
        'application_name',
    ];

    protected $casts = [
      'application_date' => 'string',
      'status' => 'string'
    ];
}

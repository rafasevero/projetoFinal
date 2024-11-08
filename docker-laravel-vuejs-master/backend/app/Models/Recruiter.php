<?php

namespace App\Models;

use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Recruiter extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'company_name',
        'cnpj',
        'cep',
        'city',
        'state',
        'is_recruiter',
        'password',
        'email',
        'perfilPicture',
        'phone',
    ];

    protected $hidden = [
        'is_recruiter',
        'password'
    ];

    protected $casts = [
        'company_name' => 'string',
        'cnpj' => 'string',
        'social_name' => 'string',
        'address' => 'string',
        'is_recruiter' => 'boolean',
        'password' => 'hashed',
        'email' => 'string',
        'perfilPicture' => 'string',
        'phone' => 'string',
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancies::class);
    }
}

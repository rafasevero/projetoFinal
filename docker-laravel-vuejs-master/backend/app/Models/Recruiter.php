<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Recruiter extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'company_name',
        'cnpj',
        'social_name',
        'address',
        'is_recruiter',
        'password',
        'email',
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
    ];
}

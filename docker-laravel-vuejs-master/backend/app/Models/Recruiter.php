<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'company_name',
        'cnpj',
        'social_name',
        'address'
    ];

    protected $casts = [
        'full_name' => 'string',
        'company_name' => 'string',
        'cnpj' => 'integer',
        'social_name' => 'string',
        'address' => 'string',
    ];
}

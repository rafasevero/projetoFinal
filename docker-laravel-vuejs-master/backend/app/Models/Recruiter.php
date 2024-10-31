<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'cnpj',
        'social_name',
        'address'
    ];

    protected $casts = [
        'company_name' => 'string',
        'cnpj' => 'integer',
        'social_name' => 'string',
        'address' => 'string',
    ];
}

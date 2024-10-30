<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;
    protected $fillable = [
      'application_date',
      'status',
    ];

    protected $casts = [
      'application_date' => 'string',
      'status' => 'string'

    ];
}
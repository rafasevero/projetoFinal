<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardskill extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
    ];
    protected $casts = [
        'descricao' => 'string',
    ];
}

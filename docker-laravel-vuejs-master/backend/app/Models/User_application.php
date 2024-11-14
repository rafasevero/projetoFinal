<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User_application extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'application_id',
    ];


}

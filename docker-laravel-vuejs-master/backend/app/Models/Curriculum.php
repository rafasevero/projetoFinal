<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'user_id'
    ];

    protected $casts = [
        'file' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

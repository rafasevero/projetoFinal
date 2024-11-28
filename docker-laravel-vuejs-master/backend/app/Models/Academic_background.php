<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_background extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'education_level',
     
    ];

    protected $casts = [
        'education_level' => 'string',
  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

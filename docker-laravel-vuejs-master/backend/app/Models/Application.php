<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Applications extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(User_application::class);
    }

    protected $fillable = [
      'application_date',
      'status',
    ];

    protected $casts = [
      'application_date' => 'string',
      'status' => 'string'

    ];
}

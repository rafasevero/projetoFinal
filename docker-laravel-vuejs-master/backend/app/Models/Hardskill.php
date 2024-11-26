<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardskill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'descricao',
    ];
    protected $casts = [
        'descricao' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

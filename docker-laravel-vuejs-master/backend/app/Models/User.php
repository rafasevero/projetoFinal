<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'user_application', 'user_id', 'application_id')
            ->using(User_application::class);
    }

    // Método para verificar se o usuário é recrutador
    public function isRecruiter(): bool
    {
        return $this->is_recruiter;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'date_of_birth',
        'cpf',
        'cep',
        'city',
        'state',
        'phone',
        'is_recruiter',
        'perfilPicture',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'cpf',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'full_name' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'cpf' => 'string',
        'cep' => 'string',
        'city' => 'string',
        'state' => 'string',
        'phone' => 'integer',
        'is_recruiter' => 'boolean',
        'perfilPicture' => 'string'//'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

    ];

}

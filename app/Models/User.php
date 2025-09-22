<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'money',
        'token',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'money' => 'decimal:2',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->token)) {
                $user->token = Str::random(60);
            }
        });
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        "money",
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'tariffs';

    protected $fillable = [
        'name',
        'coefficient',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tariff_id');
    }
}

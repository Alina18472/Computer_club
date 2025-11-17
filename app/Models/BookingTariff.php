<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class BookingTariff extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'booking_tariffs';

    protected $fillable = [
        'tariff_id',
        'booking_id',
        'start_time',
        'end_time',
        'price',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}

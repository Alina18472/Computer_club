<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Booking extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'bookings';

    protected $fillable = [
        'computer_id',
        'user_id',
        'tariff_id',
        'code_id',
        'club_id',
        'start_time',
        'end_time',
        'minutes',
        'price_for_pc',
        'price_for_additions',
        'total_price',
        'status',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'additional_menu')
            ->withTimestamps();
    }
}

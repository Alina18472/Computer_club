<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'additional_menu';

    protected $fillable = [
        'booking_id',
        'food_id ',
        'count',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

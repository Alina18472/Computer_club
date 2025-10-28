<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'foods';
    protected $fillable = [
        'name',
        'type',
        'price',
        'count',
        'path_to_img',
        'club_id'
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'additional_menu')
            ->withTimestamps();
    }
}

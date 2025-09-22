<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Booking extends Model
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;

    protected $fillable = [
        'computer_id',
        'user_id',
        'start_time',
        'end_time',
        'minutes',
        'total_price',
        'status',
    ];


    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_price' => 'decimal:2',
    ];


    public function computer(): BelongsTo
    {
        return $this->belongsTo(Computer::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

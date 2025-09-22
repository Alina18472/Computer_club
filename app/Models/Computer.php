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
class Computer extends Model
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;
    protected $fillable = [
        'price_id',
        'spec_id',
        'position_id',
        'is_active',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function price(): BelongsTo
    {
        return $this->belongsTo(ComputerPrice::class);
    }

    public function spec(): BelongsTo
    {
        return $this->belongsTo(ComputerSpec::class);
    }


    public function position(): BelongsTo
    {
        return $this->belongsTo(ComputerPosition::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

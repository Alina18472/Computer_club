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

class ComputerPrice extends Model
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;

    protected $table = 'computer_prices';
    protected $fillable = [
        'name',
        'price_per_hour',
    ];


    protected $casts = [
        'price_per_hour' => 'decimal:2',
    ];


    public function computers(): HasMany
    {
        return $this->hasMany(Computer::class, 'price_id');
    }
}

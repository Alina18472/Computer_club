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
class Tarif extends Model
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;
    protected $fillable = [
        'from',
        'to',
        'name',
        'coefficient',
        'description',
    ];


    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'coefficient' => 'decimal:2',
    ];
}

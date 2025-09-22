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
class ComputerSpecs extends Model
{
    use HasApiTokens,HasRoles,HasFactory, Notifiable;
    protected $table = 'computer_specs';
    protected $fillable = [
        'RAM',
        'processor',
        'GPU',
        'monitor',
        'headphones',
        'mouse',
        'keyboard',
    ];

    public function computer(): HasOne
    {
        return $this->hasOne(Computer::class, 'spec_id');
    }
}

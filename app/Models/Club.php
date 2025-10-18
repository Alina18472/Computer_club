<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'clubs';

    protected $fillable = [
        'address',
        'phone',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

}

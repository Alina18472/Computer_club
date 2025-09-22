<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ComputerPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'column',
        'name',

    ];

    public function computer(): HasOne
    {
        return $this->hasOne(Computer::class, 'position_id');
    }
}

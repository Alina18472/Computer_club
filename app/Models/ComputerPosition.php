<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComputerPosition extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'computer_positions';

    protected $fillable = [
        'room',
        'number',
        'coefficient',
        'club_id',

    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function computers()
    {
        return $this->hasMany(Computer::class, 'position_id');
    }
}

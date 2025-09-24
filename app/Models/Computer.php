<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computer extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'computers';

    protected $fillable = [
        'price',
        'spec_id',
        'position_id',
        'is_active',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function spec()
    {
        return $this->belongsTo(ComputerSpec::class, 'spec_id');
    }

    public function position()
    {
        return $this->belongsTo(ComputerPosition::class, 'position_id');
    }
}

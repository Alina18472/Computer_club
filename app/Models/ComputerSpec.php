<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComputerSpec extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'computer_specs';

    protected $fillable = [
        'ram',
        'processor',
        'gpu',
        'monitor',
        'headphones',
        'mouse',
        'keyboard',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function computers()
    {
        return $this->hasMany(Computer::class, 'spec_id');
    }
}

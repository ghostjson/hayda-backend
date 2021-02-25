<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static where(string $string, string $string1, string $string2)
 */
class HealthHub extends Model
{
    protected $table = 'health_hub';
    protected $guarded = [];

    use HasFactory;
}

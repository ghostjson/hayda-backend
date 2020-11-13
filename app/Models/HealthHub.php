<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class HealthHub extends Model
{
    protected $table = 'health_hub';
    protected $guarded = [];

    use HasFactory;
}

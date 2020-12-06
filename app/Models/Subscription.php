<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed price
 * @property mixed|string name
 * @property mixed|string[] features
 * @method static where(string $string, string $string1)
 */
class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];
}

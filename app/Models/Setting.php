<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $key)
 * @method static updateOrCreate(string[] $array, string[] $array1)
 */
class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
}

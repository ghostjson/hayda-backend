<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static create(array $array)
 */
class Workout extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value);
    }

    public function setDatesAttribute($value)
    {
        $this->attributes['dates'] = json_encode($value);
    }

}

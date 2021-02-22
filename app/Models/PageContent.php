<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string content
 * @property mixed|string name
 * @method static where(string $string, string $name)
 * @method static create(array $validated)
 */
class PageContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getContentAttribute($value)
    {

        return json_decode($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static count()
 * @method static where(string $string, string $string1, string $string2)
 */
class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'blog';

    public function getAuthorAttribute($value)
    {
        return User::find($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

}

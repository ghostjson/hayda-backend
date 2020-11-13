<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'blog';

}
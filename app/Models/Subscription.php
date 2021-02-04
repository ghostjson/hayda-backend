<?php

namespace App\Models;

use App\Modules\StripeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed price
 * @property mixed|string name
 * @property mixed|string[] features
 * @property mixed stripe_id
 * @property mixed stripe_price_id
 * @method static where(string $string, string $string1)
 */
class Subscription extends Model
{
    use HasFactory, StripeTrait;

    protected $guarded = [];

    protected $table = 'subscriptions_info';

    protected static function boot()
    {
        parent::boot();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property mixed session_id
 * @property mixed|string status
 * @property mixed subscription
 * @method static where(string $string, $session_id)
 */
class PaymentSession extends Model
{
    use HasFactory;
}

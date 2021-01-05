<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @method static where(string $string, int|string|null $id)
 */
class Weight extends Model
{
    use HasFactory;

    protected $table = 'weight';
    protected $guarded = [];


    public static function getWeight()
    {
        $weightObj = Weight::where('user_id', auth()->id());
        return json_decode($weightObj->first()->data);
    }

    public static function add(array $weight)
    {
        $data = [];
        $weightObj = Weight::where('user_id', auth()->id());

        if($weightObj->exists()){
            $data = json_decode($weightObj->first()->data);
        }

        array_push($data, $weight);
        Weight::updateOrCreate(
            ['user_id' => auth()->id()],
            ['data' => json_encode($data)]
        );
    }

    public static function clearWeight()
    {
        $weightObj = Weight::where('user_id', auth()->id());

        if($weightObj->exists()){
            $m = $weightObj->first();
            $m->data = json_encode([]);
            $m->save();
        }
    }

}

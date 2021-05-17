<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static where(string $string, string $string1, string $string2)
 * @method static select(string $string)
 * @property mixed link_priority
 * @property mixed category
 * @property mixed caption
 */
class HealthHub extends Model
{
    protected $table = 'health_hub';
    protected $guarded = [];

    use HasFactory;


    public static function boot()
    {
       parent::boot();


           self::creating(function($model){

               // check if the category already exists
               if (HealthHub::where('category', '=', $model->category)->exists()){

                   // set category priority
                   $model->category_priority = HealthHub::where('category', '=', $model->category)
                       ->first()->category_priority;

                   // set link priority
                   $model->link_priority = HealthHub::where('category', '=', $model->category)
                       ->get()->count();

               }else{

                   // if category doesn't exists, set category priority to no of categories
                   $category_priority = count(
                       HealthHub::select('category')
                           ->distinct('category')
                           ->get()
                   );

                   $model->category_priority = $category_priority;
                   $model->link_priority = 0;

               }





       });
    }
}

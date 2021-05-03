<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed email
 * @property mixed id
 * @property mixed name
 * @property mixed role
 * @property mixed subscription
 * @property mixed zip_code
 * @property mixed weight
 * @property mixed height
 * @property mixed age
 * @property mixed gender
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'subscription' => $this->subscription,
            'zip_code' => $this->zip_code,
            'weight' => $this->weight,
            'height' => $this->height,
            'age' => $this->age,
            'gender' => $this->gender,
        ];
    }
}

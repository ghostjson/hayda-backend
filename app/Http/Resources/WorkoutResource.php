<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed meta
 * @property mixed dates
 * @property mixed user_id
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed duration
 * @property mixed met_goal
 */
class WorkoutResource extends JsonResource
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
            'id' => $this->id,
            'meta' => json_decode($this->meta),
            'dates' => json_decode($this->dates),
            'duration' => json_decode($this->duration),
            'user_id' => $this->user_id,
            'met_goal' => json_decode($this->met_goal),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

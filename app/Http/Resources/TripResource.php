<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'trip_name'=> $this->trip_name,
            'trip_destination'=> $this->trip_destination,
            'trip_start_date'=> $this->trip_start_date,
            'trip_end_date'=> $this->trip_end_date,
            'trip_planner_name'=> $this->trip_planner_name,
            'destination_google_map_url'=> $this->destination_google_map_url,
            'trip_background_image'=> $this->trip_background_image,
        ];
    }
}

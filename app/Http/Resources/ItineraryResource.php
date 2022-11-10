<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItineraryResource extends JsonResource
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
            'location_name' => $this->location_name,
            'description' => $this->description,
            'itinerary_start_time' => $this->itinerary_start_time,
            'itinerary_end_time' => $this->itinerary_end_time,
            'location_latitude' => $this->location_latitude,
            'location_longitude' => $this->location_longitude,
            'location_image' => $this->location_image,
            'itinerary_date' => $this->itinerary_date,
            'ratings' => $this->ratings,
            'number_of_reviews' => $this->number_of_reviews,
            'location_type' => $this->location_type,
            'location_google_map_url' => $this->location_google_map_url,
            //'is_public' => $this->is_public,
            'user_id' => $this->user_id,
            'trip_id' => $this->trip_id,


        ];
    }
}

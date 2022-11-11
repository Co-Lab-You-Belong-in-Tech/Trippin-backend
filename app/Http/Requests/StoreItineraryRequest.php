<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItineraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location_name' => 'required|string',
            'description' => 'string',
            'itinerary_date' => 'string',
            'itinerary_start_time' => 'required|string',
            'itinerary_end_time' => 'required|string',
            'location_latitude' => 'numeric',
            'location_longitude' => 'numeric',
            'location_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ratings' => 'numeric',
            'number_of_reviews' => 'numeric',
            'location_type' => 'string',
        ];
    }
}

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
            'trip_name' => 'required|string',
            'trip_destination' => 'required|string',
            'trip_start_date' => 'required|date',
            'trip_end_date' => 'required|date',
            'trip_planner_name' => 'required|string',
            'email' => 'nullable|email',
            'destination_google_map_url' => 'required|string',
            'trip_background_image_url' => 'required|string',
        ];
    }
}

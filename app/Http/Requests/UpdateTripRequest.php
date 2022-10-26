<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        //check for put or patch request to update trip
        $method = $this->method();
        switch ($method) {
            case 'PUT':
                return [
                    'trip_name' => 'required|string|max:255',
                    'trip_destination' => 'required|string|max:255',
                    'trip_start_date' => 'required|date',
                    'trip_end_date' => 'required|date',
                    'planner_name' => 'string|max:255',
                    'email' => 'required|string|email|max:255',
                    'destination_google_map_url' => 'required|string|max:255',
                    'trip_background_image_url' => 'required|string|max:255',
                ];
            case 'PATCH':
                return [
                    'trip_name' => 'sometimes','string|max:255',
                    'trip_destination' => 'sometimes','string|max:255',
                    'trip_start_date' => 'sometimes','date',
                    'trip_end_date' => 'sometimes','date',
                    'planner_name' => 'sometimes','string|max:255',
                    'email' => 'sometimes','string|email|max:255',
                    'destination_google_map_url' => 'sometimes','string|max:255',
                    'trip_background_image_url' => 'sometimes','string|max:255',
                ];
            default:
                return [];
        }

    }
}

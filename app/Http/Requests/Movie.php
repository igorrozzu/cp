<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Movie
 * @package App\Http\Requests
 * @property string $description
 * @property int $duration
 * @property int $rating
 * @property string $name
 * @property string $slogan
 */
class Movie extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string',
            'duration' => 'required|int',
            'rating' => 'required|int',
            'slogan' => 'required|string',
            'name' => 'required|string',
        ];
    }
}

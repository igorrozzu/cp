<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShownMovie
 * @package App\Http\Requests
 * @property string $cinemaId
 * @property string $showingFrom
 * @property string $showingTo
 */
class ShownMovie extends FormRequest
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
            'cinemaId' => 'required|int',
            'showingFrom' => 'required|date',
            'showingTo' => 'required|date|after:showingFrom',
        ];
    }
}

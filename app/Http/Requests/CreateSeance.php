<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateSeance
 * @package App\Http\Requests
 * @property int $cost
 * @property int $movieShowingId
 * @property int $showingDate
 */
class CreateSeance extends FormRequest
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
            'cost' => 'required|int',
            'movieShowingId' => 'required|int',
            'showingDate' => 'required|date',
        ];
    }
}

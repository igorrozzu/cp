<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Cinema
 * @package App\Http\Requests
 * @property string $manager
 * @property string $address
 * @property int $phone
 * @property string $name
 */
class Cinema extends FormRequest
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
            'manager' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|int',
            'name' => 'required|string',
        ];
    }
}

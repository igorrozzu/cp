<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class User
 * @package App\Http\Requests
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $phoneNumber
 * @property int $creditCard
 */
class User extends FormRequest
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
            'login' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'phoneNumber' => 'required|int',
            'creditCard' => 'required|int',
        ];
    }
}

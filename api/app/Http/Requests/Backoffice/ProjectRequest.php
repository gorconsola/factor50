<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'string|required',
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'string|required',
            'street' => 'string|required',
            'house_number' => 'string|required',
            'house_number_addition' => 'string|nullable',
            'postal_code' => 'string|nullable',
            'city' => 'string|nullable',
            'country' => 'string|nullable',
        ];
    }
}

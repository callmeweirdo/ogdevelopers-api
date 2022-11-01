<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeRequest extends FormRequest
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
            'home_welcome' => ['required', 'min:10', 'max:40'],
            'home_title' => ['required', 'min:10', 'max:50'],
            'home_description' => ['required', 'min:80', 'max:200'],
            'about_title' => ['required', 'min:10', 'max:50'],
            'about_description' => ['required', 'min:80', 'max:300']

        ];
    }
}

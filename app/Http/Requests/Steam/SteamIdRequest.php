<?php

namespace App\Http\Requests\Steam;

use Illuminate\Foundation\Http\FormRequest;

class SteamIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'steamId' => ['required','string','regex:/^\d{17}$/']
        ];
    }
}

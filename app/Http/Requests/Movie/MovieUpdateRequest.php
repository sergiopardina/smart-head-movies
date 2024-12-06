<?php

namespace App\Http\Requests\Movie;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\FormRequest;

class MovieUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genres' => 'array|nullable'
        ];
    }
}

<?php

namespace App\Http\Requests\Movie;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\FormRequest;

class MovieFilterRequest extends FormRequest
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
            'filters.ids' => 'array|nullable',
            'filters.genre_ids' => 'array|nullable',
        ];
    }
}

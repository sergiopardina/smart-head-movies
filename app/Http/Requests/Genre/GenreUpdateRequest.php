<?php

namespace App\Http\Requests\Genre;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\FormRequest;

class GenreUpdateRequest extends FormRequest
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
            'name' => 'integer|required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends LaravelFormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $messages = [];

        if (count($errors) == 0) {
            $messages[] = 'Виникла помилка. Будь-ласка, зверніться до служби підтримки';
        }else{
            foreach ($errors as $error) {
                $messages[] = $error[0];
            }
        }

        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $messages[0]
        ]));
    }
}

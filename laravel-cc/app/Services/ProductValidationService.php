<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ProductValidationService
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            // * The errors are actually a matrix that's why I used array_filter
            $m = implode(', ', array_filter(array_map(function ($v) {
                return implode(',', array_filter($v));
            }, $validator->errors()->messages())));

            $error = \Illuminate\Validation\ValidationException::withMessages([
                $m,
            ]);
            throw $error;
        }

        return $validator->validated();
    }
}

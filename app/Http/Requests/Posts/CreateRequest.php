<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $description
 * @property file $image
 */

class CreateRequest extends FormRequest
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
            'title' => ['required', 'min:5', 'max:30'],
            'description' => ['required', 'min:30', 'max:20000'],
        ];
    }
}

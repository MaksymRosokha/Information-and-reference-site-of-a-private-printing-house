<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'serviceID' => ['required', 'int'],
            'name' => ['required', 'string', 'max:300'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'image' => ['nullable', 'image', 'max:10240'],
        ];
    }
}

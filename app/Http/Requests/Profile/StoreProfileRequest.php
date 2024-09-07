<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'lastname' => ['required', 'string', 'max:100'],
            'document_number' => ['required', 'string', 'digits: 9','unique:profiles,document_number'],
            'age' => ['required', 'integer', 'max:120'],
            'address' => ['required', 'string', 'max:200'],
            'user_id' => ['required', 'integer', 'exists:users,id','unique:profiles,user_id']
        ];
    }
}

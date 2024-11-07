<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractorLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can add logic to check if the user is authorized to make this request
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ];
    }
}


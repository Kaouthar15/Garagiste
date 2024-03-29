<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'firstName' =>'required|string',
            'lastName' =>'required|string',
            'address' =>'required|string',
            'phoneNumber' =>'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'isClient' => 'nullable|boolean',
            'isMechanic' => 'nullable|boolean',
            'password' => 'required|min:8', 
            'confirmation' => 'required|same:password', 
            
        ]; 
    }
}

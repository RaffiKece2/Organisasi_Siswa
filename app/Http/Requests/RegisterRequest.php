<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => 'required|string|min:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
            //
        ];
    }

    public function messages() {

        return [

            'name.required' => 'nama tidak boleh kosong',
            'name.min' => 'nama tidak boleh kurang dari 10',
            'email.unique' => 'email anda sudah ada coba buat yang baru',
            'email.required' => 'email harus diisi',
            'email.email' => 'email anda salah',
            'password.required' => 'password anda kosong'


        ];

    }
}

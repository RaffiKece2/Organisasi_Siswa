<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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

            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'file' => 'required|file|max:10240'
            //
        ];
    }

    public function messages() {

        return [

            'nama.required' => 'nama harus diisi',
            'kelas.required' => 'kelas harus diisi',
            'jurusan.required' => 'jurusan harus diisi',
            'file.required' => 'gambar harus diisi',
            'file.file' => 'file anda dilarang untuk dimasukan',
            'file.max' => 'ukuran file terlalu besar'

        ];

    }
}

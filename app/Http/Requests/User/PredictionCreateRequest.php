<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PredictionCreateRequest extends FormRequest
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
            'nama' => 'required|string|max:25',
            'npm' => 'required|string|max:10',
            'ips1' => 'required|numeric|between:0,4',
            'ips2' => 'required|numeric|between:0,4',
            'ips3' => 'required|numeric|between:0,4',
            'ips4' => 'required|numeric|between:0,4',
            'ips5' => 'required|numeric|between:0,4',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'nama' => htmlspecialchars($this->input('nama')),
            'npm' => htmlspecialchars($this->input('npm')),
        ]);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * 
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'string', 'in:admin,kepala_desa'],
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'Peran harus dipilih',
            'role.in' => 'Peran yang dipilih tidak valid',
        ];
    }
}

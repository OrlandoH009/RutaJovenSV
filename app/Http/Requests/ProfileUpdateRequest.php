<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'department' => ['nullable', 'string', Rule::in(array_keys(config('el_salvador.departments')))],
            'municipality' => ['nullable', 'string', function ($attribute, $value, $fail) {
                $department = $this->input('department');
                $valid = $department ? (config('el_salvador.departments')[$department] ?? []) : [];

                if ($value && ! in_array($value, $valid, true)) {
                    $fail('Selecciona un municipio válido para el departamento elegido.');
                }
            }],
            'academic_level' => ['nullable', 'string', 'max:100'],
            'bachillerato_type' => ['nullable', 'string', 'max:100'],
        ];
    }
}

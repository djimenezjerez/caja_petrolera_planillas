<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCredencialRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'empresa' => ['required', 'string', 'min:1', 'max:255'],
            'gestion_inicial' => ['required', 'integer', 'min:1970', 'max:2050'],
            'gestion_final' => ['required', 'integer', 'min:1970', 'max:2050', 'gte:gestion_inicial'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'empresa' => mb_strtoupper($this->empresa),
        ]);
    }
}

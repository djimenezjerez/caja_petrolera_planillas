<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadExcelRequest extends FormRequest
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
            'fila' => 'required|integer|min:1|max:65535',
            'columna' => 'required|integer|min:0|max:255',
            'archivo' => 'required|file|mimes:xls,xlsx',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'columna' => columna_excel($this->columna),
        ]);
    }
}

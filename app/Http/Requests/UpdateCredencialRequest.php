<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCredencialRequest extends FormRequest
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
            // Credencial
            'credencial_id' => ['required', 'exists:credenciales,id'],
            'credencial_cite' => ['required', 'string', 'min:1', 'max:255', 'unique:credenciales,cite,'.$this->credencial_id],
            'credencial_inicio_fizcalizacion' => ['required', 'date'],
            'credencial_gestion_inicial' => ['required', 'integer', 'min:1970', 'max:2050'],
            'credencial_gestion_final' => ['required', 'integer', 'min:1970', 'max:2050', 'gte:credencial_gestion_inicial'],
            // Empresa
            'empresa_nombre' => ['required', 'string', 'min:1', 'max:255'],
            'empresa_fecha_afiliacion' => ['required', 'date'],
            'empresa_nit' => ['nullable', 'integer'],
            'empresa_regimen_tributario_id' => ['nullable', 'exists:regimenes_tributarios,id'],
            'empresa_actividad' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_numero_empleador' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_tipo_empresa_id' => ['nullable', 'exists:tipos_empresas,id'],
            'empresa_fundempresa' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_roe' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_telefonos' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_ciudad_id' => ['nullable', 'exists:ciudades,id'],
            'empresa_domicilio' => ['nullable', 'string', 'min:1', 'max:255'],
            'empresa_domicilio_representante' => ['nullable', 'string', 'min:1', 'max:255'],
            // Representante Legal
            'representante_apellido_paterno' => ['nullable', 'string', 'min:1', 'max:255'],
            'representante_apellido_materno' => ['nullable', 'string', 'min:1', 'max:255'],
            'representante_nombre' => ['nullable', 'string', 'required_with:representante_apellido_paterno'],
            'representante_cedula_identidad' => ['nullable', 'integer', 'required_with:representante_apellido_paterno'],
            'representante_complemento_cedula' => ['nullable', 'string', 'min:1', 'max:255'],
            'representante_ciudad_id' => ['nullable', 'exists:ciudades,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $credencial_inicio_fizcalizacion = null;
        try {
            $credencial_inicio_fizcalizacion = Carbon::createFromFormat('d/m/Y', $this->credencial_inicio_fizcalizacion)->format('Y-m-d');
        } catch (\Exception $e) {}
        $empresa_fecha_afiliacion = null;
        try {
            $empresa_fecha_afiliacion = Carbon::createFromFormat('d/m/Y', $this->empresa_fecha_afiliacion)->format('Y-m-d');
        } catch (\Exception $e) {}
        $this->merge([
            'credencial_inicio_fizcalizacion' => $credencial_inicio_fizcalizacion,
            'empresa_fecha_afiliacion' => $empresa_fecha_afiliacion,
            'credencial_cite' => $this->credencial_cite != null ? mb_strtoupper($this->credencial_cite) : null,
            'empresa_nombre' => $this->empresa_nombre != null ? mb_strtoupper($this->empresa_nombre) : null,
            'empresa_numero_empleador' => $this->empresa_numero_empleador != null ? mb_strtoupper($this->empresa_numero_empleador) : null,
            'empresa_actividad' => $this->empresa_actividad != null ? mb_strtoupper($this->empresa_actividad) : null,
            'empresa_tipo_empresa' => $this->empresa_tipo_empresa != null ? mb_strtoupper($this->empresa_tipo_empresa) : null,
            'empresa_fundempresa' => $this->empresa_fundempresa != null ? mb_strtoupper($this->empresa_fundempresa) : null,
            'empresa_roe' => $this->empresa_roe != null ? mb_strtoupper($this->empresa_roe) : null,
            'empresa_telefonos' => $this->empresa_telefonos != null ? mb_strtoupper($this->empresa_telefonos) : null,
            'empresa_domicilio' => $this->empresa_domicilio != null ? mb_strtoupper($this->empresa_domicilio) : null,
            'empresa_domicilio_representante' => $this->empresa_domicilio_representante != null ? mb_strtoupper($this->empresa_domicilio_representante) : null,
            'representante_apellido_paterno' => $this->representante_apellido_paterno != null ? mb_strtoupper($this->representante_apellido_paterno) : null,
            'representante_apellido_materno' => $this->representante_apellido_materno != null ? mb_strtoupper($this->representante_apellido_materno) : null,
            'representante_nombre' => $this->representante_nombre != null ? mb_strtoupper($this->representante_nombre) : null,
            'representante_complemento_cedula' => $this->representante_complemento_cedula != null ? mb_strtoupper($this->representante_complemento_cedula) : null,
        ]);
    }
}

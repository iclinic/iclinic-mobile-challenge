<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clinic_id' => 'required|string|exists:clinics,id',
            'patient_id' => 'required|string|exists:patients,id',
            'physician_id' => 'required|string|exists:physicians,id',
            'text' => 'required|string'
        ];
    }
}

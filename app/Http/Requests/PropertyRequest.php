<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'pass_easy_broker' => 'Clave EASYBROKER',
            'price' => 'precio',
            'form_pay_id' => 'Formas de pago'

        ];
    }

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

            'address' => 'required',
            'cve_int_cliente' => 'exists:clients,id',
            'Avaluo' => 'requiredIf:avaluo,activo',
            'cp' => 'required',
            'pass_easy_broker' => 'required|unique:properties',
            'price' => 'required',
            'form_pay_id' => 'required'
        ];
    }
}

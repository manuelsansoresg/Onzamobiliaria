<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyEditRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'pass_easy_broker' => 'Clave EASYBROKER',
            'price' => 'precio',
            'form_pay_id' => 'Formas de pago',
            'cliente.nombre' => 'nombre',

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
        $user_id = \Request::segments()[2];
        
        return [

            'address' => 'required',
            //'cve_int_cliente' => 'unique:clients,id,!0' ,
            'Avaluo' => 'requiredIf:avaluo,activo',
            'cp' => 'required',
            'pass_easy_broker' => 'required|unique:properties,pass_easy_broker,' . $user_id,
            'price' => 'required',
            'form_pay_id' => 'required',
            
        ];
    }
}

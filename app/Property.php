<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{

    static function getById($id)
    {
        $property = Property::select(
            'realstates.description as realstate_description',
            'properties.id',
            'operations.description as operations_description',
            'form_payments.description as form_payment_description',
            'Avaluo',
            'assessment',
            'habitar',
            'is_property'
        )
            ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
            ->join('operations', 'operations.id', '=', 'properties.operation_id')
            ->join('form_payments', 'form_payments.id', '=', 'properties.form_pay_id')
            ->where('properties.id', $id )
            ->get();
        return $property;
    }


    static function getAll()
    {
        $property = Property::select('realstates.description as realstate_description',
                                    'properties.id',
                                    'operations.description as operations_description',
                                    'form_payments.description as form_payment_description',
                                    'Avaluo',
                                    'assessment',
                                    'habitar',
                                    'is_property'
                                    )
                        ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
                        ->join('operations', 'operations.id', '=', 'properties.operation_id')
                        ->join('form_payments', 'form_payments.id', '=', 'properties.form_pay_id')
                        ->get();
        return $property;
    }


    static function createProperty($request, $path)
    {
     
        $get_cp = Postal::where('id', $request->colonia )->first();
        
        $property               = new Property();
        $property->realstate_id = $request->inmobiliaria;
        $property->Avaluo       = $request->avaluo;
        $property->operation_id = $request->operacion;
        $property->price        = $request->precio;
        $property->postal_id    = $get_cp->id;
        $property->street       = $request->calle;
        $property->noInt        = $request->no_interior;
        $property->noExt        = $request->no_exterior;
        $property->assessment   = $request->gravamenes;
        $property->predial      = $request->predial;
        $property->habitar      = $request->habitar;
        $property->status       = 1;
        
        if ($request->hasFile('documento') != false) {
            
            $documnet_file = $request->file('documento');
            $extension = $documnet_file->getClientOriginalExtension();
            $name_full = 'document_' . time() . '.' . $extension;
           
            $documnet_file->move('.'.$path, $name_full);

            $property->document     = $name_full;
        }

        $property->form_pay_id      = $request->pago;
        $property->institution      = $request->institucion;
        $property->name             = $request->nombre;
        $property->email            = $request->email;
        $property->phone_contact    = $request->telefono;
        $property->celular          = $request->celular;
        $property->celular2         = $request->celular2;
        $property->is_property      = $request->propietario;
        $property->observation1     = $request->observacion;
        $property->observation2     = $request->observacion2;
        $property->observation3     = $request->observacion3;
        $property->user_id          = Auth::id();
        $property->date_write       = date('Y-m-d H:i:s');
        $property->rooms            = $request->habitacion;
        $property->bathrooms        = $request->banios;
        $property->pass_easy_broker = $request->clave_easybroke;
        $property->save();

    }

}

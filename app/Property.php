<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{


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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property extends Model
{

    static function getById($id)
    {
        $property = Property::select(
            'realstates.description as realstate_description',
            'properties.id',
            'properties.status as status',
            'operations.description as operations_description',
            'form_payments.description as form_payment_description',
            'Avaluo',  'assessment', 'habitar', 'is_property',
            'postal_id',  'realstate_id', 'operation_id', 'form_pay_id',
            'street', 'noInt', 'noExt',
            'price',  'predial' , 'institution',
            'name', 'email',
            'phone_contact',  'celular' , 'celular2',
            'observation1', 'observation2', 'observation3',
            'rooms', 'bathrooms', 'pass_easy_broker',
            'document',
            'postal.codigo as codigo', 'colonia'
        )
            ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
            ->join('operations', 'operations.id', '=', 'properties.operation_id')
            ->join('form_payments', 'form_payments.id', '=', 'properties.form_pay_id')
            ->join('postal', 'postal.id', '=', 'properties.postal_id')
            ->where('properties.id', $id )
            ->first();
        return $property;
    }


    static function getAll()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();
        
        DB::enableQueryLog();

        $property = Property::select('realstates.description as realstate_description',
                                    'properties.id',
                                    'operations.description as operations_description',
                                    'form_payments.description as form_payment_description',
                                    'Avaluo',
                                    'assessment',
                                    'habitar',
                                    'pass_easy_broker',
                                    'properties.clave_interna',
                                    'is_titulo',
                                    'price',
                                    'address',
                                    'is_property',
                                    'properties.status as status',
            'metros_construccion',
            'metros_terreno',
            'frente',
            'fondo',
                                    
                                    )
                        ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
                        ->join('operations', 'operations.id', '=', 'properties.operation_id')
                        ->leftJoin('clients', 'clients.id', '=', 'properties.client_id')
                        ->join('form_payments', 'form_payments.id', '=', 'properties.form_pay_id');

        if($user_role != 'admin'){
            $property = $property->where('properties.user_id', $user->id);
        }
        
        $property = $property->get();
        
        return $property;
    }

    


    static function createUpdateProperty($request, $path, $isUpdate = false, $property_id = null)
    {
     
        $get_cp = Postal::where('id', $request->colonia )->first();

        if ($isUpdate == false) {
            $property  = new Property();
        }else{
            $property = Property::find($property_id);
        }

        $property->realstate_id = $request->inmobiliaria; //departamento-local-terreno
        $property->Avaluo       = $request->avaluo;
        $property->operation_id = $request->operacion; //preventa-venta-renta
        $property->price        = $request->precio;
        $property->postal_id    = $get_cp->id;
        $property->street       = $request->calle;
        $property->noInt        = $request->no_interior;
        $property->noExt        = $request->no_exterior;
        $property->assessment   = $request->gravamenes;
        $property->predial      = $request->predial; // si o no
        $property->habitar      = $request->habitar;
        $property->status       = $request->status;
        
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
        
        if($isUpdate == false){
            $property->save();
        }else{
            $property->update();
        }

        return $property;   

    }

    static function addUserProperty($property_id, $user_id)
    {
        $property = Property::find($property_id);
        $property->user_id_capture = $user_id;
        $property->date_assignment = date('Y-m-d H:i:s');
        $property->update();
    }

}

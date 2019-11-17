<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    protected $fillable = [
        'realstate_id', 'operation_id', 'postal_id', 'form_pay_id',
        'inmobiliaria','operacion', 'avaluo', 'address', 'small', 'gravamenes', 'price', 'saldo', 'is_predial', 'habitar', 'document',
        'pago','metros_construccion','metros_terreno','frente','fondo','estado_conservacion_antiguedad','infraestructura_zona',
        'pass_easy_broker', 'identificacion','curp', 'rfc', 'acta_nacimiento', 'acta_matrimonio', 'predial', 'no_adeudo_agua', 'no_adeudo_predial', 'cedula_plano_catastral', 'copia_escritura', 'reglamento_condominios_no_adeudo'];
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
            'fondo'
                                    
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
            $client   = Client::where('clave_interna', $request->cve_int_cliente)->first();
            $property = new Property($request->except('_token', 'cve_int_cliente', 'identificacion',
            'curp','rfc','acta_nacimiento','acta_matrimonio','predial','no_adeudo_agua','no_adeudo_predial','cedula_plano_catastral','copia_escritura','reglamento_condominios_no_adeudo' ));
            $property->client_id = $client->id;
        }else{
            $property = Property::find($property_id);
            $property->fill($request->except(
                '_token',
                'cve_int_cliente',
                'identificacion',
                'curp',
                'rfc',
                'acta_nacimiento',
                'acta_matrimonio',
                'predial',
                'no_adeudo_agua',
                'no_adeudo_predial',
                'cedula_plano_catastral',
                'copia_escritura',
                'reglamento_condominios_no_adeudo'
            ) );
        }
       
       /*  $property->realstate_id = $request->inmobiliaria; //departamento-local-terreno
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
        $property->status       = $request->status; */
        
       /*  if ($request->hasFile('documento') != false) {
            
            $documnet_file = $request->file('documento');
            $extension = $documnet_file->getClientOriginalExtension();
            $name_full = 'document_' . time() . '.' . $extension;
           
            $documnet_file->move('.'.$path, $name_full);

            $property->document     = $name_full;
        } */

        /* $property->form_pay_id      = $request->pago;
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
        $property->pass_easy_broker = $request->clave_easybroke; */
       
        if($isUpdate == false){
            $property->save();
        }else{
            $property->update();
        }
        
        $path_file = $path . '/' . $property->id.'/';

        
        if ($request->hasFile('cve_int_cliente') != false) {
            self::copyFie($request, 'cve_int_cliente', $path_file);
            $property->cve_int_cliente = $request->cve_int_cliente;
        }
        if ($request->hasFile('identificacion') != false) {
            self::copyFie($request, 'identificacion', $path_file);
            $property->identificacion = $request->identificacion;
        }
        if ($request->hasFile('curp') != false) {
            self::copyFie($request, 'curp', $path_file);
            $property->curp = $request->curp;
        }
        if ($request->hasFile('rfc') != false) {
            self::copyFie($request, 'rfc', $path_file);
            $property->rfc = $request->rfc;
        }
        if ($request->hasFile('acta_nacimiento') != false) {
            self::copyFie($request, 'acta_nacimiento', $path_file);
            $property->acta_nacimiento = $request->acta_nacimiento;
        }
        if ($request->hasFile('acta_matrimonio') != false) {
            self::copyFie($request, 'acta_matrimonio', $path_file);
            $property->acta_matrimonio = $request->acta_matrimonio;
        }
        if ($request->hasFile('predial') != false) {
            self::copyFie($request, 'predial', $path_file);
            $property->predial = $request->predial;
        }
        if ($request->hasFile('no_adeudo_agua') != false) {
            self::copyFie($request, 'no_adeudo_agua', $path_file);
            $property->no_adeudo_agua = $request->no_adeudo_agua;
        }
        if ($request->hasFile('no_adeudo_predial') != false) {
            self::copyFie($request, 'no_adeudo_predial', $path_file);
            $property->no_adeudo_predial = $request->no_adeudo_predial;
        }
        if ($request->hasFile('cedula_plano_catastral') != false) {
            self::copyFie($request, 'cedula_plano_catastral', $path_file);
            $property->cedula_plano_catastral = $request->cedula_plano_catastral;
        }
        if ($request->hasFile('copia_escritura') != false) {
            self::copyFie($request, 'copia_escritura', $path_file);
            $property->copia_escritura = $request->copia_escritura;
        }
        if ($request->hasFile('reglamento_condominios_no_adeudo') != false) {
            self::copyFie($request, 'reglamento_condominios_no_adeudo', $path_file);
            $property->reglamento_condominios_no_adeudo = $request->reglamento_condominios_no_adeudo;
        }

        return $property;   

    }

    static function copyFie($request, $name, $path)
    {
        $documnet_file = $request->file($name);
        $extension = $documnet_file->getClientOriginalExtension();
        $name_full = 'document_' . time() . rand(1,10).  '.' . $extension;

        $documnet_file->move('.' . $path, $name_full);
    }

    static function addUserProperty($property_id, $user_id)
    {
        $property = Property::find($property_id);
        $property->user_id_capture = $user_id;
        $property->date_assignment = date('Y-m-d H:i:s');
        $property->update();
    }

    static function drop($path, $id)
    {
        
        $property = Property::find($id);
        
        $path_file = $path . '/' . $property->id . '/';

        @unlink($path_file . $property->cve_int_cliente);
        @unlink($path_file . $property->identificacion);
        @unlink($path_file . $property->curp);
        @unlink($path_file . $property->rfc);
        @unlink($path_file . $property->acta_nacimiento);
        @unlink($path_file . $property->acta_matrimonio);
        @unlink($path_file . $property->predial);
        @unlink($path_file . $property->no_adeudo_agua);
        @unlink($path_file . $property->no_adeudo_predial);
        @unlink($path_file . $property->cedula_plano_catastral);
        @unlink($path_file . $property->copia_escritura);
        @unlink($path_file . $property->reglamento_condominios_no_adeudo);
        $property->delete();
    }

}

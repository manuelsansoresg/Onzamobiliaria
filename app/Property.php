<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    protected $fillable = [
        'realstate_id', 'operation_id', 'postal_id', 'institution', 'assessment', 'observation1',
        'inmobiliaria','operacion', 'Avaluo', 'address', 'small', 'gravamenes', 'price', 'saldo', 'is_predial', 'habitar', 'document',
        'pago','metros_construccion','metros_terreno','frente','fondo','estado_conservacion_antiguedad','infraestructura_zona',
        'pass_easy_broker', 'identificacion','curp', 'rfc', 'acta_nacimiento', 'acta_matrimonio', 'predial', 'no_adeudo_agua', 'no_adeudo_predial', 'cedula_plano_catastral', 'copia_escritura', 'reglamento_condominios_no_adeudo'];
    
    static function getById($id)
    {
        $property = Property::select(
            'client_id',
            'realstate_id', 'operation_id','institution','saldo',
            'clients.clave_interna as cve_int_cliente',
            'realstates.description as realstate_description',
            'properties.id',
            'operations.description as operations_description',
            'Avaluo',
            'is_avaluo',
            'assessment',
            'habitar',
            'is_predial',
            'document',
            'form_pays',
            'estado_conservacion_antiguedad',
            'infraestructura_zona',
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
            'reglamento_condominios_no_adeudo',
            'colonia',
            'codigo',
            'postal_id',
            'observation1',
            'is_new'
            
        )
            ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
            ->join('operations', 'operations.id', '=', 'properties.operation_id')
            ->leftJoin('postal', 'postal.id', '=', 'properties.postal_id')
            ->leftJoin('clients', 'clients.id', '=', 'properties.client_id')
            ->where('properties.id', $id )
            ->first();
        return $property;
    }


    static function getAll()
    {
        $user           = User::find(Auth::id());
        $user_role      = $user->getRoleNames()->first();
        $fecha_inicial  = (isset($_GET['fecha_inicial'])) ? date($_GET['fecha_inicial']) : '';
        $fecha_final    = (isset($_GET['fecha_final'])) ? date($_GET['fecha_final']) : '';
        $status         = (isset($_GET['status'])) ? $_GET['status'] : '';

        
        DB::enableQueryLog();

        $property = Property::select('realstates.description as realstate_description',
                                    'properties.id',
                                    'operations.description as operations_description',
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
                                    'metros_construccion','metros_terreno', 'frente', 'fondo'
                                    
                                    )
                        ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
                        ->join('operations', 'operations.id', '=', 'properties.operation_id')
                        ->leftJoin('clients', 'clients.id', '=', 'properties.client_id');

        if($user_role != 'admin'){
            $property = $property->where('properties.user_id', $user->id);
        }

        if($fecha_inicial != ''){
            $property = $property->whereBetween('properties.created_at', [$fecha_inicial, $fecha_final] );
        }
        
        if($status != ''){
            $property = $property->where('properties.status', $status );
        }
        
        $property = $property->get();
        
        return $property;
    }

    static function searchByEasyBroker($easy_broker)
    {
        $property = Property::select('users.name as asesor', 'realstates.description as tipo', 'operations.description as operacion', 'colonia', 'price')
                            ->leftJoin('postal', 'postal.id', '=', 'properties.postal_id')
                            ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
                            ->join('users', 'users.id', '=', 'properties.user_id')
                            ->join('operations', 'operations.id', '=', 'properties.operation_id')
                            ->where('pass_easy_broker', $easy_broker)
                            ->first();
        return array('property' => $property, 'total' => ($property)? 1 : 0 );
    }


    static function createUpdateProperty($request, $path, $isUpdate = false, $property_id = null)
    {
     
        $get_cp    = Postal::where('id', $request->colonia )->first();
        $n_client  = ($request->n_client != null) ? 1: 0;
        
        $form_pays = '';

        foreach ($request->form_pay_id as $form_pay) {
            $form_pays .= ",$form_pay";
        }

        $form_pays = trim($form_pays , ',');
        

        if ($isUpdate == false) {
            
            if($n_client == 0){
                $client   = Client::find($request->cve_int_cliente)->first();
            }
            
            $property            = new Property($request->except('_token',
                'form_pay_id', 'cve_int_cliente', 'identificacion',
            'curp','rfc','acta_nacimiento','acta_matrimonio','predial','no_adeudo_agua','no_adeudo_predial','cedula_plano_catastral','copia_escritura','reglamento_condominios_no_adeudo',
                'n_client',
                'cliente' ));
            if ($n_client == 0) {
                $property->client_id = $client->id;
            }
            $property->is_avaluo = ($request->Avaluo == '')? 0: 1;
            $property->postal_id = $get_cp->id;
            $property->form_pays = $form_pays;
            $property->user_id   = Auth::id();
            $property->is_new   = $n_client;
        
        }else{

            $property = Property::find($property_id);
            if ($n_client == 0) {
                $client   = Client::find($request->cve_int_cliente)->first();
            }
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
                'reglamento_condominios_no_adeudo','n_client',
                'cliente'
            ) );

            $property->postal_id = $get_cp->id;
            $property->is_avaluo = ($request->Avaluo == '') ? 0: 1;
            $property->form_pays = $form_pays;
            $property->is_new   = $n_client;
            if ($n_client == 0) {
                $property->client_id = $client->id;
            }
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

        if ($isUpdate == false) {
            $property = Property::find($property->id);
        } 
        
        if ($request->hasFile('cve_int_cliente') != false) {
            $name_file = self::copyFie($request, 'cve_int_cliente', $path_file);
            $property->cve_int_cliente = $name_file;
        }
        if ($request->hasFile('identificacion') != false) {
            $name_file = self::copyFie($request, 'identificacion', $path_file);
            $property->identificacion = $name_file;
        }
        if ($request->hasFile('curp') != false) {
            $name_file = self::copyFie($request, 'curp', $path_file);
            $property->curp = $name_file;
        }
        if ($request->hasFile('rfc') != false) {
            $name_file = self::copyFie($request, 'rfc', $path_file);
            $property->rfc = $name_file;
        }
        if ($request->hasFile('acta_nacimiento') != false) {
            $name_file = self::copyFie($request, 'acta_nacimiento', $path_file);
            $property->acta_nacimiento = $name_file;
        }
        if ($request->hasFile('acta_matrimonio') != false) {
            $name_file = self::copyFie($request, 'acta_matrimonio', $path_file);
            $property->acta_matrimonio = $name_file;
        }
        if ($request->hasFile('predial') != false) {
            $name_file = self::copyFie($request, 'predial', $path_file);
            $property->predial = $name_file;
        }
        if ($request->hasFile('no_adeudo_agua') != false) {
            $name_file = self::copyFie($request, 'no_adeudo_agua', $path_file);
            $property->no_adeudo_agua = $name_file;
        }
        if ($request->hasFile('no_adeudo_predial') != false) {
            $name_file = self::copyFie($request, 'no_adeudo_predial', $path_file);
            $property->no_adeudo_predial = $name_file;
        }
        if ($request->hasFile('cedula_plano_catastral') != false) {
            $name_file = self::copyFie($request, 'cedula_plano_catastral', $path_file);
            $property->cedula_plano_catastral = $name_file;
        }
        if ($request->hasFile('copia_escritura') != false) {
            $name_file = self::copyFie($request, 'copia_escritura', $path_file);
            $property->copia_escritura = $name_file;
        }
        if ($request->hasFile('reglamento_condominios_no_adeudo') != false) {
            $name_file = self::copyFie($request, 'reglamento_condominios_no_adeudo', $path_file);
            $property->reglamento_condominios_no_adeudo = $name_file;
        }

        
        if($n_client == 1){
            $client = new Client($request->cliente);
            
            $client->save();
            $property->client_id = $client->id;
        }
        
        $property->update();
        return $property;   

    }

    static function copyFie($request, $name, $path)
    {
        $documnet_file = $request->file($name);
        $extension = $documnet_file->getClientOriginalExtension();
        $name_full = 'document_' . time() . rand(1,10).  '.' . $extension;

        $documnet_file->move('.' . $path, $name_full);
        return $name_full;
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
        
        $path_file = '.'.$path . '/' . $property->id . '/';

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

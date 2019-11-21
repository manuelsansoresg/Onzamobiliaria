<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property_assigment extends Model
{
    protected $table    = 'property_assignment';
    protected $fillable = ['property_id', 'nombre', 'telefono','correo','add_id', 'asesor_id'];
    
    static function create($request, $id = null)
    {
        if($id == null){
            $property = Property::where('pass_easy_broker', $request->easy_broker)->first();
            $property_assigment = new Property_assigment($request->except('_token', 'easy_broker'));
            $property_assigment->property_id = $property->id;
            $property_assigment->save();
        }else{
            $property = Property::where('pass_easy_broker', $request->easy_broker)->first();
            $property_assigment = Property_assigment::find($id);
            $property_assigment->fill($request->except('_token', 'easy_broker'));
            $property_assigment->property_id = $property->id;
            $property_assigment->update();
        }

        
    }


    static function getAll()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $property  = Property::select('pass_easy_broker', 'properties.id',
            'property_assignment.id as assignment_id', 'realstates.description as propiedad', 
                            'colonia', 'operations.description as operacion', 'price', 'pu.name as asesor', 'ads.description as portal',
            'property_assignment.nombre as nombre_prospecto',
            'property_assignment.telefono',
            'property_assignment.correo',
            'su.name as asesor_asignado')
                       ->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id' )
                        ->leftJoin('ads', 'ads.id', '=', 'property_assignment.add_id')
                       ->leftJoin('postal', 'postal.id', '=', 'properties.postal_id')
                       ->join( DB::raw('users pu'), DB::raw('pu.id') , '=' , 'properties.user_id')
                       ->join( DB::raw('users su'), DB::raw('su.id') , '=' , 'property_assignment.asesor_id')
                        ->leftJoin('realstates', 'realstates.id', '=', 'properties.realstate_id')
                        ->join('operations', 'operations.id', '=', 'properties.operation_id')
                        ->where('properties.status', 1);
        
        if ($user_role != 'admin') {
            $property = $property->where('properties.user_id_capture', $user->id);
        }

        $property = $property->get();                
        return $property;
    }

    static function getAllTable()
    {
        $properties = self::getAll();
        $table      = array();
        $user       = User::find(Auth::id());
        $user_role  = $user->getRoleNames()->first();

        if ($properties) {
            foreach ($properties as $property) {
                
                $llamadas = Property_assigment::where('property_id', $property->id)->count();
                $date1    = new DateTime(date('Y-m-d H:i:s', strtotime($property->date_assignment)));
                $date2    = new DateTime("now");
                $diff     = $date1->diff($date2);
                $dias     = $diff->format('%d');


                if ($user_role == 'admin') {
                    
                    $alert = '';

                    if ($dias > 0) {
                        $alert = '<i class="fas fa-exclamation-circle text-danger"></i>';
                    }
                    
                    $table[] = array(
                        $alert.' Calle:'. $property->street.' Número int:'.$property->noInt . ' Número ext:' . $property->noExt,
                                $property->pass_easy_broker,
                                $dias,
                                $property->name,
                                ' <a href="/admin/seguimiento-asesores/lista/'.$property->id.'" class="btn btn-primary">
                                    <i class="fas fa-phone-volume"></i>
                                </a>'
                                );
                }else{
                    
                    if ($dias < 1) {
                        
                        $table[] = array(
                                        'Calle:'.$property->street.' Número int:'.$property->noInt . ' Número ext:' . $property->noExt,
                                        $property->pass_easy_broker,
                                        $llamadas,
                                        
                                        ' <a href="/admin/seguimiento-asesores/lista/' . $property->id . '" class="btn btn-primary">
                                                <i class="fas fa-phone-volume"></i>
                                            </a>'
                                    );
                    }
                }
            }
        }


        //$table_head->{$title} = 'Dirección';

        /* 
         */
        if ($user_role == 'admin') {
            $table_head[] = array('title' => 'DIRECCIÓN');
            $table_head[] = array('title' => 'EASYBROKER');
            $table_head[] = array('title' => 'NÚMERO DE LLAMADAS');
            $table_head[] = array('title' => 'ASIGNADO');
            $table_head[] = array('title' => '');
        }else{
            $table_head[] = array('title' => 'DIRECCIÓN');
            $table_head[] = array('title' => 'EASYBROKER');
            $table_head[] = array('title' => 'NÚMERO DE LLAMADAS');
            $table_head[] = array('title' => '');
        }
        //$table_head = array('Dirección', 'Easybroker');
       
        
        return array('table' => $table, 'table_head' => $table_head );
    }

    static function getAssigmentByyId($property_id)
    {
        # code...
    }

    static function getById($id)
    {
        $property = Property::select(
            'pass_easy_broker',
            'properties.id',
            'property_assignment.id as assignment_id',
            'realstates.description as propiedad',
            'colonia',
            'operations.description as operacion',
            'price',
            'pu.name as asesor',
            'ads.description as portal',
            'property_assignment.nombre as nombre_prospecto',
            'property_assignment.telefono',
            'property_assignment.correo',
            'property_assignment.add_id',
            'property_assignment.asesor_id',
            'su.name as asesor_asignado')
                    ->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id')
                    ->leftJoin('ads', 'ads.id', '=', 'property_assignment.add_id')
                    ->leftJoin('postal', 'postal.id', '=', 'properties.postal_id')
                    ->join(DB::raw('users pu'), DB::raw('pu.id'), '=', 'properties.user_id')
                    ->join(DB::raw('users su'), DB::raw('su.id'), '=', 'property_assignment.asesor_id')
                    ->leftJoin('realstates', 'realstates.id', '=', 'properties.realstate_id')
                    ->join('operations', 'operations.id', '=', 'properties.operation_id')
                    ->where('properties.status', 1)
                    ->where('property_assignment.id', $id)
                    ->first();
        return $property;
    }

    static function countCalls($property_id)
    {
        $property = Property_assigment::select('property_id')->where('property_id', $property_id)->count();
        return $property;
    }

    

    static function getAlert($property_id)
    {
        #saber si se puso en contacto
        $property     = Property::select('date_assignment')->find($property_id);
        $date1        = new DateTime(date('Y-m-d H:i:s', strtotime($property->date_assignment)));
        $date2        = new DateTime("now");
        $diff         = $date1->diff($date2);
        $dias         = $diff->format('%d');
        $class_danger = '';

        if($dias > 0){
            $property = Property_assigment::select('property_id')->where('property_id', $property_id)->count();
            $class_danger = 'danger';
        }
        
        return $class_danger;
    }

}

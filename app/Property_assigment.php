<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property_assigment extends Model
{
    protected $table    = 'property_assignment';
    protected $fillable = ['property_id', 'nombre', 'telefono','correo','add_id', 'asesor_id', 'date_assignment'];

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

    static function search()
    {
       

        $properties = self::getAll();

        
        return $properties;

    }

    static function getAll()
    {
        $campo =  $_GET['campo'];
        $filtro = $_GET['filtro'];

        
        DB::enableQueryLog();
        $user      = User::find(Auth::id());

        $user_role = $user->getRoleNames()->first();

        $property  = Property::select(
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
            'su.name as asesor_asignado',
            'property_assignment.date_assignment'
        )
            ->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id')
            ->leftJoin('ads', 'ads.id', '=', 'property_assignment.add_id')
            ->leftJoin('postal', 'postal.id', '=', 'properties.postal_id')
            ->leftJoin(DB::raw('users pu'), DB::raw('pu.id'), '=', 'properties.user_id')
            ->leftJoin(DB::raw('users su'), DB::raw('su.id'), '=', 'property_assignment.asesor_id')
            ->leftJoin('realstates', 'realstates.id', '=', 'properties.realstate_id')
            ->leftJoin('operations', 'operations.id', '=', 'properties.operation_id')
            ->where('properties.status', 1);

        if ($user_role != 'admin') {
            $property = $property->where('property_assignment.asesor_id', Auth::id());
        }

        if ($campo != '') {
            $property = $property->where(function ($q) use ($campo) {
                $q->orWhere('pass_easy_broker', 'like', "%$campo%");
                $q->orWhere('property_assignment.nombre', 'like', "%$campo%");
                $q->orWhere('price', '>=', $campo);
            });
        }


        $property   = $property->get();
        $properties = [];
        $is_error = false;
        
        if ($filtro != 'TODOS') {
            
            foreach ($property as $row) {

                $assigment = HistoricAssigment::where('status_follow_id', $filtro)->where('property_assignment_id', $row->assignment_id)->count();
                $is_error = true;
                if ($assigment > 0) {
                    $is_error = false;
                    $properties[] = $row;
                }
            }
        } else {
            $properties = $property;
        }
        //dd(DB::getQueryLog());
        if($is_error == true){
            $property =  [];
        }
        return $property;
    }

    static function getAllTable()
    {
        $properties = self::getall();
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
                $alert    = '';

                if ($dias > 0) {
                    $alert = '<i class="fas fa-exclamation-circle text-danger"></i>';
                }

                if ($user_role == 'admin') {


                    /* $table.= '<tr>';
                    $table.= '<td> <span class="small">'. $alert. $property->pass_easy_broker.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->propiedad.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->colonia.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->operacion.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->price.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->asesor.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->portal.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->nombre_prospecto.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->telefono.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->correo.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->asesor_asignado.' </span> </td>';
                    $table.= '<td>';
                    $table.=  '<form method="POST" action="/admin/seguimiento-asesores/'. $property->assignment_id.'" accept-charset="UTF-8" class="form-inline">';
                    $table.= '<input name="_method" type="hidden" value="DELETE">';
                    $table.= '<input name="_token" type="hidden" value="'. csrf_token().'">';
                    $table.= '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-primary">
                                <i class="fas fa-phone-volume"></i>
                            </a>';
                    $table.= '<a href="http://onzamobiliaria.test/admin/seguimiento-asesores/'. $property->assignment_id.'/edit" class="btn btn-primary ml-1">
                                <i class="far fa-edit"></i>
                            </a>';
                    $table.= '<button onclick="return confirm(\'¿Deseas eliminar el elemento?\')" class="btn btn-danger ml-1">
                                <i class="far fa-trash-alt"></i>
                            </button>';
                    $table.= '</form>';
                    $table.= '</td>';
                    $table.= '/<tr>'; */

                    $table[] = array(
                                $alert.' '.$property->pass_easy_broker,
                                $property->propiedad,
                                $property->colonia,
                                $property->operacion,
                                $property->price,
                                $property->asesor,
                                $property->portal,
                                $property->nombre_prospecto,
                                $property->telefono,
                                $property->correo,
                                $property->asesor_asignado,
                                //'llamadas'=>$llamadas,
                                ' <a href="/admin/seguimiento-asesores/lista/'.$property->id.'" class="btn btn-primary">
                                    <i class="fas fa-phone-volume"></i>
                                </a>'
                                );
                }else{

                    if ($dias < 1) {

                        $table.= '<tr>';
                        $table.= '<td> <span class="small">'. $alert. $property->pass_easy_broker.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->propiedad.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->colonia.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->operacion.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->price.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->asesor.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->portal.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->nombre_prospecto.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->telefono.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->correo.' </span> </td>';
                        $table.= '<td>';
                        $table.=  '<form method="POST" action="/admin/seguimiento-asesores/'. $property->assignment_id.'" accept-charset="UTF-8" class="form-inline">';
                        $table.= '<input name="_method" type="hidden" value="DELETE">';
                        $table.= '<input name="_token" type="hidden" value="'. csrf_token().'">';
                        $table.= '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-primary">
                                <i class="fas fa-phone-volume"></i>
                            </a>';

                        $table.= '</form>';
                        $table.= '</td>';
                        $table.= '/<tr>';
                    }
                }
            }
        }

        
        //$table_head->{$title} = 'Dirección';

        /*
         */
        if ($user_role == 'admin') {
            $table_head[] = array('title' => 'CVE EASYBROKER');
            $table_head[] = array('title' => 'PROPIEDAD');
            $table_head[] = array('title' => 'COLONIA');
            $table_head[] = array('title' => 'OPERACIÓN');
            $table_head[] = array('title' => 'PRECIO');
            $table_head[] = array('title' => 'ASESOR');
            $table_head[] = array('title' => 'PORTAL');
            $table_head[] = array('title' => 'NOMBRE PROSPECTO');
            $table_head[] = array('title' => 'TELEFONO');
            $table_head[] = array('title' => 'CORREO');
            $table_head[] = array('title' => 'ASIGNAR ASESOR');
            $table_head[] = array('title' => 'LLAMADAS');
            $table_head[] = array('title' => '');
        }else{
            $table_head[] = array('title' => 'DIRECCIÓN');
            $table_head[] = array('title' => 'EASYBROKER');
            $table_head[] = array('title' => 'NÚMERO DE LLAMADAS');
            $table_head[] = array('title' => '');
        }
        //$table_head = array('Dirección', 'Easybroker');


        return array('data' => $table, 'table_head' => $table_head );
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

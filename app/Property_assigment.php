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
    protected $fillable = ['property_id', 'nombre', 'telefono','correo','add_id', 'asesor_id', 'date_assignment', 'porcentaje_comision'];

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

    public static function getAllAssigment()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $property_assigment = Property_assigment::select(
                                        'property_assignment.id as assignment_id',
                                        'property_assignment.created_at',
                                         'property_assignment.nombre as nombre_prospecto',
                                        'property_assignment.telefono',
                                        'property_assignment.correo',
                                        'property_assignment.date_assignment',
                                        'users.name as asesor'
                                        )
                                ->join('properties', 'properties.id', '=', 'property_assignment.property_id')
                                ->join('users', 'users.id', '=', 'property_assignment.asesor_id')
                                ->where('properties.status', 1);
        if ($user_role != 'admin') {
            $property_assigment = $property_assigment->where('property_assignment.asesor_id', Auth::id());
        }
        $property_assigment = $property_assigment->get();
        return $property_assigment;
    }

    static function getAll($assignment_id = "")
    {
        $campo =  (isset($_GET['campo']))?$_GET['campo']: '';
        $filtro = (isset($_GET['filtro']))?$_GET['filtro']: '';


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
            'properties.price',
            'pu.name as asesor',
            'ads.description as portal',
            'property_assignment.nombre as nombre_prospecto',
            'property_assignment.telefono',
            'property_assignment.correo',
            'su.name as asesor_asignado',
            'property_assignment.date_assignment'
        )
            ->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id')
            ->join('ads', 'ads.id', '=', 'property_assignment.add_id')
            ->join('postal', 'postal.id', '=', 'properties.postal_id')
            ->join(DB::raw('users pu'), DB::raw('pu.id'), '=', 'properties.user_id')
            ->join(DB::raw('users su'), DB::raw('su.id'), '=', 'property_assignment.asesor_id')
            ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
            ->join('operations', 'operations.id', '=', 'properties.operation_id')
            ->orderBy('property_assignment.date_assignment', 'desc')
            ->where('properties.status', 1);
        if($assignment_id != ''){
            $property = $property->where('property_assignment.id', $assignment_id);
        }

        if ($user_role != 'admin') {
            $property = $property->where('property_assignment.asesor_id', Auth::id());
        }

        /*if ($campo != '') {
            $property = $property->where(function ($q) use ($campo) {
                $q->orWhere('pass_easy_broker', 'like', "%$campo%");
                $q->orWhere('property_assignment.nombre', 'like', "%$campo%");
                $q->orWhere('price', '>=', $campo);
            });
        }*/

        $property   = $property->get();
        $is_error   = false;

       /* if ($filtro!= '' && $filtro != 'TODOS') {
            $properties = [];
            foreach ($property as $row) {

                $assigment = HistoricAssigment::where('status_follow_id', $filtro)->where('property_assignment_id', $row->assignment_id)->count();
                //echo $assigment;
                if ($assigment > 0) {
                    $properties[] = $row;
                }
            }
        } else {
            $properties = $property;
        }*/

        return $property;
    }

    static function getAllTable()
    {
        $properties = self::getAllAssigment();

        $table      = array();
        $user       = User::find(Auth::id());
        $user_role  = $user->getRoleNames()->first();
        $td_option  = '';

        if ($properties) {
            foreach ($properties as $property) {

                $llamadas = HistoricAssigment::where('property_assignment_id', $property->assignment_id)->count();
                $date1    = new DateTime(date('Y-m-d H:i:s', strtotime($property->date_assignment)));
                $date2    = new DateTime("now");
                $diff     = $date1->diff($date2);
                $dias     = $diff->format('%d');
                $alert    = '';

                if ($dias > 0 && $llamadas == 0) {
                    $alert = 'NO';


                }else{
                    $assigment = Property_assigment::find($property->assignment_id);
                    $assigment->is_seguimiento = 1;
                    $assigment->update();
                    $alert = 'SÍ';
                 }



                if ($user_role == 'admin') {

                    /*$table.= '<tr>';
                    $table.= '<td> '.$alert.' </td>';
                    $table.= '<td> <span class="small">'. $property->pass_easy_broker.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->propiedad.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->colonia.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->operacion.' </span> </td>';
                    $table.= '<td> <span class="small">'. precio($property->price).' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->asesor.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->portal.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->nombre_prospecto.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->telefono.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->correo.' </span> </td>';
                    $table.= '<td> <span class="small">'. $property->asesor_asignado.' </span> </td>';
                    $table.= '<td> <span class="small">'. $llamadas.' </span> </td>';
                    $table.= '<td>';

                    $table.=  '<form method="POST" action="/admin/seguimiento-asesores/'. $property->assignment_id.'" accept-charset="UTF-8" class="form-inline">';
                    $table.= '<input name="_method" type="hidden" value="DELETE">';
                    $table.= '<input name="_token" type="hidden" value="'. csrf_token().'">';
                    $table.= '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-primary">
                                <i class="fas fa-phone-volume"></i>
                            </a>';
                    $table.= '<a href="http://onzamobiliaria.test/admin/seguimiento-asesores/'. $property->assignment_id.'/edit" class="mt-1 btn btn-primary ">
                                <i class="far fa-edit"></i>
                            </a>';
                    $table.= '<button onclick="return confirm(\'¿Deseas eliminar el elemento?\')" class="mt-1 btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>';
                    $table.= '</form>';
                    $table.= '</td>';
                    $table.= '/<tr>';*/

                   /* $td_option.=  '<form method="POST" action="/admin/seguimiento-asesores/'. $property->assignment_id.'" accept-charset="UTF-8" class="form-inline">';
                    $td_option.= '<input name="_method" type="hidden" value="DELETE">';
                    $td_option.= '<input name="_token" type="hidden" value="'. csrf_token().'">';
                    $td_option.= '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-primary">
                                <i class="fas fa-phone-volume"></i>
                            </a>';
                    $td_option.= '<a href="/admin/seguimiento-asesores/'. $property->assignment_id.'/edit" class="btn btn-primary ml-1">
                                <i class="far fa-edit"></i>
                            </a>';
                    $td_option.= '<button onclick="return confirm(\'¿Deseas eliminar el elemento?\')" class="btn btn-danger ml-1">
                                <i class="far fa-trash-alt"></i>
                            </button>';
                    $td_option.= '</form> ';*/

                    $td_option = '';
                    $table[] = array(
                        $alert,
                        date('Y-m-d', strtotime( $property->date_assignment)),
                        $property->nombre_prospecto,
                        $property->telefono,
                        $property->asesor,
                        self::getStatysAssigmentId($property->assignment_id),
                        "<a onclick=\"viewMore('".$property->assignment_id."')\" class=\"btn btn-primary text-white\"> <i class=\"fas fa-plus-square\"></i> </a>".
                        '<a href="/admin/seguimiento-asesores/'. $property->assignment_id.'/edit" class="btn btn-secondary ml-md-1  text-white"> <i class="fas fa-edit"></i> </a>'.
                        '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-success text-white ml-md-1"> <i class="fas fa-phone"></i> </a>'

                    );
                }else{

                    //dd($dias);
                    if ($dias < 1 || $llamadas > 0) {

                        $table[] = array(
                            date('Y-m-d', strtotime( $property->date_assignment)),
                            $property->nombre_prospecto,
                            $property->telefono,
                            self::getStatysAssigmentId($property->assignment_id),
                            "<a onclick=\"viewMore('".$property->assignment_id."')\" class=\"btn btn-primary text-white\"> <i class=\"fas fa-plus-square\"></i> </a>".
                            '<a href="/admin/historico-seguimiento/' . $property->assignment_id.'" class="btn btn-success text-white ml-md-1"> <i class="fas fa-phone"></i> </a>'

                        );

                        /*$table.= '<tr>';
                        $table.= '<td> <span class="small">'.  $property->pass_easy_broker.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->propiedad.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->colonia.' </span> </td>';
                        $table.= '<td> <span class="small">'. $property->operacion.' </span> </td>';
                        $table.= '<td> <span class="small">'. precio($property->price).' </span> </td>';
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
                        $table.= '</tr>';*/



                        /*$table[] = array(
                            $alert . ' ' . $property->pass_easy_broker,
                            $property->propiedad,
                            $property->colonia,
                            $property->operacion,
                            precio($property->price),
                            $property->asesor,
                            $property->portal,
                            $property->nombre_prospecto,
                            $property->telefono,
                            $property->correo,
                            //'llamadas'=>$llamadas,
                            ' <a href="/admin/historico-seguimiento/' . $property->assignment_id . '" class="btn btn-primary">
                                    <i class="fas fa-phone-volume"></i>
                                </a>'
                        );*/

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

    public static function getStatysAssigmentId($property_assignment_id)
    {
        /*DB::enableQueryLog();*/
        $historic = HistoricAssigment::select('status_follows.description')
                                        ->join('status_follows', 'status_follows.id', '=' , 'historic_assigments.status_follow_id')
                                        ->where('historic_assigments.property_assignment_id', $property_assignment_id)
                                        ->orderBy('historic_assigments.created_at', 'desc')
                                        ->first();
        /*dd( DB::getQueryLog());*/
        $status = 'disponible';

        if(is_object($historic)){
            $status = ''.$historic->description.'';
            if($historic->description == 'SUSPENDIDA' || $historic->description == 'CANCELADA'){
                $status = ''.$historic->description.'';
            }
        }
        //$status = $historic->description;
        return $status;
        /*return DB::getQueryLog();*/

    }

    static function getAssigmentByyId($property_id)
    {
        $properties = self::getall($property_id);
        return $properties;
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

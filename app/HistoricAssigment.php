<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoricAssigment extends Model
{
    protected $fillable = ['property_assignment_id', 'observacion1', 'observacion2', 'observacion3', 'status_follow_id','historic_assigments.created_at'];

    static function getById($id_assigment)
    {
        $user       = User::find(Auth::id());
        $user_role  = $user->getRoleNames()->first();

        $assigment = HistoricAssigment::select('historic_assigments.id', 'status_follows.description as status', 'historic_assigments.observacion1', 'historic_assigments.created_at as fecha')
                                    ->join('property_assignment', 'property_assignment.id', '=', 'historic_assigments.property_assignment_id')
                                    ->join('status_follows', 'status_follows.id', '=', 'historic_assigments.status_follow_id')
                                    ->where('property_assignment_id', $id_assigment);
        if ($user_role != 'admin') {
            $assigment = $assigment->where('asesor_id', Auth::id());
        }

         $assigment =  $assigment ->get();

         return $assigment;
    }

    static function createUpdateHistoric($request, $historic_id = null){
        
        if ($historic_id == false) {
            $historico = new HistoricAssigment($request->except('_token'));
        }else{
            $historico = HistoricAssigment::find($historic_id);
            $historico->fill($request->except('_token'));
        }

        $form_pays = '';

        foreach ($request->forma_pago as $form_pay) {
            $form_pays .= ",$form_pay";
        }

        $form_pays = trim($form_pays, ',');

        $historico->forma_pago = $form_pays;

        if ($historic_id == false) {
            $historico->save();
        }else{
            $historico->update();
        }

        return $historico;

    }  
}

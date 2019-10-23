<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lead extends Model
{

    static function getById($id)
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $lead = Lead::select('leads.id as id', 'street', 'n_in', 'n_out', 'phone', 'leads.date',  'leads.status',
                        'postal.codigo as codigo',
                        'leads.status',
                        'colonia',
            'postal_id',
            'realstate_id',
            'operation_id',
            'clasification_id' ,
            'share' ,
            'mobile' ,
            'observation1',
            'observation2',
            'observation3'
                            )
            ->join('realstates', 'realstates.id', '=', 'leads.realstate_id')
            ->join('operations', 'operations.id', '=', 'leads.operation_id')
            ->join('clasifications', 'clasifications.id', '=', 'leads.clasification_id')
            ->join('postal', 'postal.id', '=', 'leads.postal_id')
            ->where('leads.id', $id)
            ->first();

        
        return $lead;
       
    }

    static function getAll()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $lead = Lead::select('leads.id', 'street', 'n_in', 'n_out', 'phone', 'leads.date',  'leads.status')
            ->join('realstates', 'realstates.id', '=', 'leads.realstate_id')
            ->join('operations', 'operations.id', '=', 'leads.operation_id')
            ->join('clasifications', 'clasifications.id', '=', 'leads.clasification_id');

        if ($user_role != 'admin') {
            $lead = $lead->where('leads.user_id', $user->id);
        }

        $lead = $lead->get();
        return $lead;
    }

    static function createUpdate ($request, $isUpdate = false, $lead_id = null)
    {
        if ($isUpdate == false) {
            $lead = new Lead();
        }else{
            $lead = Lead::find($lead_id);
        }

        $lead->date             = $request->date;
        $lead->realstate_id     = $request->realstate_id;
        $lead->operation_id     = $request->operation_id;
        $lead->phone            = $request->phone;
        $lead->mobile           = $request->mobile;
        $lead->share            = $request->share;
        $lead->postal_id        = $request->colonia;
        $lead->street           = $request->street;
        $lead->n_in             = $request->n_in;
        $lead->n_out            = $request->n_out;
        $lead->status           = $request->status;
        $lead->user_id          = Auth::id();
        $lead->clasification_id = $request->clasification_id;
        $lead->observation1      = $request->observation1;
        $lead->observation2      = $request->observation2;
        $lead->observation3      = $request->observation3;
        $lead->date_write       = date('Y-m-d H:i:s');


        if ($isUpdate == false) {
            $lead->save();
        } else {
            $lead->update();
        }

        return $lead;   

    }

}

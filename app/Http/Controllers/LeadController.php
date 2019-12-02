<?php

namespace App\Http\Controllers;

use App\Clasification;
use App\Http\Requests\LeadRequest;
use App\Images_lead;
use App\Lead;
use App\Operation;
use App\Postal;
use App\Realstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    protected $path_image;

    
    public function __construct()
    {
        $this->path_image = './img/lead';
        
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Lead::getAll();
        return view('prospecto.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $real_states    = Realstate::where('status', 1)->get();
        $operations     = Operation::where('status', 1)->get();
        $clasifications = Clasification::where('status', 1)->get();

        return view('prospecto.create', compact('real_states', 'operations', 'clasifications' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadRequest $request)
    {
        Lead::createUpdate($request, $this->path_image);
        flash('Elemento guardado');
        return redirect('/admin/prospecto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $real_states    = Realstate::where('status', 1)->get();
        $operations     = Operation::where('status', 1)->get();
        $clasifications = Clasification::where('status', 1)->get();
        $lead           = Lead::find($id);
        $images         = Images_lead::where('lead_id', $id)->get(  );
        $path_image     = $this->path_image;

        return view('prospecto.edit', compact('real_states', 'operations', 'clasifications', 'lead', 'images', 'path_image'));
    }

    public function delete_image($id)
    {
        $image        = Images_lead::find($id);
        $id_prospecto = $image->lead_id;

        @unlink($this->path_image.'/'.$image->name);
        @unlink($this->path_image.'/thumb_'.$image->name);
        
        $image->delete();

        return redirect('/admin/prospecto/'. $id_prospecto.'/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeadRequest $request, $id)
    {
        $lead = Lead::createUpdate($request, $this->path_image, $id);
        flash('Elemento guardado');
        return redirect('/admin/prospecto');
    }

    public function changeStatus($id, $status)
    {

        $lead = Lead::find($id);
        $lead->status = $status;
        if ($status == 0) {
            $lead->user_id_cancel = Auth::id();
        }
        $lead->update();
        return redirect('/admin/prospecto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $lead = Lead::delete_images($this->path_image, $id);
        
        flash('Elemento borrado');
        return redirect('/admin/prospecto');
    }
}

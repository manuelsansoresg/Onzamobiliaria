<?php

namespace App\Http\Controllers;

use App\FormPayment;
use App\Http\Requests\PropertyRequest;
use App\Operation;
use App\Postal;
use App\Property;
use App\Realstate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PropertyController extends Controller
{
    protected $path_document;
    
    public function __construct()
    {
        $this->path_document = '/propiedades';
        
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::getAll();
        return view('propiedad.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $real_states   = Realstate::where('status', 1)->get();
        $operations    = Operation::where('status', 1)->get();
        $form_payments = FormPayment::where('status', 1)->get();

        return view('propiedad.create', compact('real_states', 'operations', 'form_payments') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = Property::createUpdateProperty($request, $this->path_document );
        flash('Elemento guardado');
        return redirect('/admin/propiedad');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::getById($id);
        $pdf = PDF::loadView('propiedad.show', compact('property'));

        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        $property      = Property::getById($id);
        $real_states   = Realstate::where('status', 1)->get();
        $operations    = Operation::where('status', 1)->get();
        $form_payments = FormPayment::where('status', 1)->get();

        $postals = Postal::getById($property->postal_id);
        

        return view('propiedad.edit', compact('real_states', 'operations', 'form_payments', 'postals', 'property') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::createUpdateProperty($request, $this->path_document, true, $id);
        
        flash('Elemento guardado');
        return redirect('/admin/propiedad');
    }

    public function destroyDocument($id)
    {
        $property = Property::find($id);
        
        if($property){
            
            $document = $property->document;
            @unlink('.'.$this->path_document.'/'.$document);
            $property->document = '';
            $property->update();
        }
        return redirect('/admin/propiedad/'.$id. '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

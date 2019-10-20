<?php

namespace App\Http\Controllers;

use App\FormPayment;
use App\Http\Requests\PropertyRequest;
use App\Operation;
use App\Property;
use App\Realstate;
use Illuminate\Http\Request;

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
        $property = Property::createProperty($request, $this->path_document );
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
        $real_states   = Realstate::where('status', 1)->get();
        $operations    = Operation::where('status', 1)->get();
        $form_payments = FormPayment::where('status', 1)->get();
        $property      = Property::getById($id);

        return view('propiedad.edit', compact('real_states', 'operations', 'form_payments') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

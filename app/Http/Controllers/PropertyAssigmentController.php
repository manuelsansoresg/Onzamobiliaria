<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Http\Requests\PropertyAsigmentRequest;
use App\Property_assigment;
use App\StatusFollow;
use App\User;
use Illuminate\Http\Request;

class PropertyAssigmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $property_assignments = Property_assigment::getall();
        
        return view('Seguimiento-Asesores.index', compact('property_assignments'));
    }

    public function lista($property_id)
    {
        $property_assignments = Property_assigment::getById($property_id);
        $property_id          = $property_id;
        return view('Seguimiento-Asesores.index', compact('property_assignments', 'property_id'));
    }

    public function getAll()
    {
        $properties = Property_assigment::getAllTable();
        return response()->json($properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status   = StatusFollow::all();
        $ads      = Ad::all();
        $asesores = User::getAsesor();

        return view('Seguimiento-Asesores.create', compact('status', 'ads', 'asesores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyAsigmentRequest $request)
    {
        $property_assignment = Property_assigment::create($request);
        
        flash('Elemento guardado');
        return redirect('/admin/seguimiento-asesores');
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
        $property_assigment = Property_assigment::getById($id);
        $status             = StatusFollow::all();
        $ads                = Ad::all();
        $asesores           = User::getAsesor();
        

        return view('Seguimiento-Asesores.edit', compact('status',  'property_assigment', 'ads', 'asesores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyAsigmentRequest $request, $id)
    {
        $property_assigment = Property_assigment::create($request, $id);
        

        flash('Elemento guardado');
        return redirect('/admin/seguimiento-asesores');
    }

    public function changeStatus($id, $status)
    {

        $property_assigment = Property_assigment::find($id);
        $property_assigment->status = $status;
        $property_assigment->update();

        return redirect('/admin/seguimiento-asesores/lista/' . $property_assigment->property_id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property_assigment = Property_assigment::find($id);
        $property_assigment->delete();

        flash('Elemento borrado');
        return redirect('/admin/seguimiento-asesores/lista/' . $property_assigment->property_id);
    }
}

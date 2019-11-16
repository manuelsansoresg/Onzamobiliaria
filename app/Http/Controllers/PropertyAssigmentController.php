<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyAsigmentRequest;
use App\Property_assigment;
use App\StatusFollow;
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
        return view('Seguimiento-Asesores.list.index', compact('property_assignments', 'property_id'));
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
    public function create($property_id)
    {
        $status      = StatusFollow::all();
        $property_id = $property_id;

        

        return view('Seguimiento-Asesores.list.create', compact('status', 'property_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyAsigmentRequest $request)
    {
        $property_assignment = new Property_assigment($request->except('_token'));
        $property_assignment->save();
        

        flash('Elemento guardado');
        return redirect('/admin/seguimiento-asesores/lista/'. $request->property_id);
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
        $property_assigment = Property_assigment::find($id);
        $property_id        = $property_assigment->property_id;
        $status             = StatusFollow::all();

        return view('Seguimiento-Asesores.list.edit', compact('status', 'property_id', 'property_assigment'));

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
        $property_assigment = Property_assigment::find($id);
        $property_assigment->fill($request->except('_token'));
        $property_assigment->update();

        flash('Elemento guardado');
        return redirect('/admin/seguimiento-asesores/lista/' . $request->property_id);
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

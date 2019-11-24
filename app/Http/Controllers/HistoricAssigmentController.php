<?php

namespace App\Http\Controllers;

use App\HistoricAssigment;
use App\Http\Requests\HistoricAssigmentRequest;
use App\StatusFollow;
use Illuminate\Http\Request;

class HistoricAssigmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_assigment)
    {
        $id_assigment = $id_assigment;
        $status_all   = StatusFollow::all();

        return view('Seguimiento-Asesores.list.create', compact('id_assigment', 'status_all'));
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoricAssigmentRequest $request)
    {
        $historic = new HistoricAssigment($request->except('_token'));
        $historic->save();
        flash('Elemento guardado');
        return redirect('/admin/historico-seguimiento/'.$request->property_assignment_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistoricAssigment  $historicAssigment
     * @return \Illuminate\Http\Response
     */
    public function show($id_assigment)
    {
        $property_assignments = HistoricAssigment::getById($id_assigment);
        $id_assigment         = $id_assigment;

        return view('Seguimiento-Asesores.list.index', compact('property_assignments', 'id_assigment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoricAssigment  $historicAssigment
     * @return \Illuminate\Http\Response
     */
    public function edit($id_assigment)
    {
        $status_all   = StatusFollow::all();
        $historico     = HistoricAssigment::find($id_assigment);
        $id_assigment = $historico->property_assignment_id;

        return view('Seguimiento-Asesores.list.edit', compact('id_assigment', 'status_all', 'historico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoricAssigment  $historicAssigment
     * @return \Illuminate\Http\Response
     */
    public function update(HistoricAssigmentRequest $request, $id_assigment)
    {
        $historic = HistoricAssigment::find($id_assigment);
        $historic->fill($request->except('_token'));

        $historic->update();
        flash('Elemento guardado');
        return redirect('/admin/historico-seguimiento/' . $request->property_assignment_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoricAssigment  $historicAssigment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_assigment)
    {
        $historico     = HistoricAssigment::find($id_assigment);
        $id_assigment = $historico->property_assignment_id;

        $historico->delete();
        flash('Elemento guardado');
        return redirect('/admin/historico-seguimiento/' . $id_assigment);
    }
}

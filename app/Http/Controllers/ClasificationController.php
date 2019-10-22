<?php

namespace App\Http\Controllers;

use App\Clasification;
use App\Http\Requests\ClasificationRequest;
use Illuminate\Http\Request;

class ClasificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clasifications = Clasification::all();
        return view('clasificacion.index', compact('clasifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clasificacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasificationRequest $request)
    {
        $clasification = new Clasification($request->except('_token'));
        $clasification->save();
        flash('Elemento guardado');
        return redirect('/admin/clasificacion');
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
        $clasification = Clasification::find($id);
        return view('clasificacion.edit', compact('clasification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasificationRequest $request, $id)
    {
        $clasification = Clasification::find($id);
        $clasification->fill($request->except('_token'));
        $clasification->update();
        flash('Elemento guardado');
        return redirect('/admin/clasificacion');

    }

    public function changeStatus($id, $status)
    {
        $clasification = Clasification::find($id);
        $clasification->status = $status;
        $clasification->update();
        return redirect('/admin/clasificacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clasification = Clasification::find($id);
        $clasification->delete();
        flash('Elemento borrado');
        return redirect('/admin/clasificacion');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RealstateRequest;
use App\Realstate;
use Illuminate\Http\Request;

class RealstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $real_states = Realstate::all();
        return view('mobiliaria.index', compact('real_states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobiliaria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RealstateRequest $request)
    {
        $real_state = new Realstate($request->except('_token'));
        $real_state->save();
        flash('Elemento guardado');
        return redirect('/admin/mobiliaria');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $real_state = Realstate::find($id);
        return view('mobiliaria.edit', compact('real_state')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RealstateRequest $request, $id)
    {
        $real_state  =  Realstate::find($id);
        $real_state->fill($request->except('_token'));
        $real_state->update();
        flash('Elemento guardado');
        return redirect('/admin/mobiliaria');
    }

    public function changeStatus($id, $status)
    {
        $real_state = Realstate::find($id);
        $real_state->status = $status;
        $real_state->update();
        return redirect('/admin/mobiliaria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $real_state  =  Realstate::find($id);
        $real_state->delete();
        flash('Elemento borrado');
        return redirect('/admin/mobiliaria');
    }
}

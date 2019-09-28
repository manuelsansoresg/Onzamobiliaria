<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguimientoRequest;
use App\StatusFollow;
use Illuminate\Http\Request;

class StatusFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status_follows = StatusFollow::all();
        return view('seguimiento.index', compact('status_follows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeguimientoRequest $request)
    {
        $status_follow = new StatusFollow($request->except('_token'));
        $status_follow->save();
        flash('Elemento guardado');
        return redirect('/admin/seguimiento');
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
        $status_follow = StatusFollow::find($id);
        return view('seguimiento.edit', compact('status_follow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeguimientoRequest $request, $id)
    {
        $status_follow = StatusFollow::find($id);
        $status_follow->fill($request->except('_token'));
        $status_follow->update();
        flash('Elemento guardado');
        return redirect('/admin/seguimiento');
    }

    public function changeStatus($id, $status)
    {
        $status_follow = StatusFollow::find($id);
        $status_follow->status = $status;
        $status_follow->update();
        return redirect('/admin/seguimiento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status_follow = StatusFollow::find($id);
        $status_follow->delete();
        flash('Elemento guardado');
        return redirect('/admin/seguimiento');
    }
}

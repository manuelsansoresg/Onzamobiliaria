<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Http\Requests\AdRequest;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::all();
        return view('portales.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $ad = new Ad($request->except('_token'));
        $ad->save();
        flash('Elemento guardado');
        return redirect('/admin/portales');
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
        $ad = Ad::find($id);
        return view('portales.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, $id)
    {
        $ad = Ad::find($id);
        $ad->fill($request->except('_token'));
        $ad->update();
        flash('Elemento guardado');
        return redirect('/admin/portales');
    }

    public function changeStatus($id, $status)
    {
        $ad = Ad::find($id);
        $ad->status = $status;
        $ad->update();
        return redirect('/admin/portales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        $ad->delete();
        flash('Elemento borrado');
        return redirect('/admin/portales');
    }
}

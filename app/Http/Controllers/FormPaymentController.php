<?php

namespace App\Http\Controllers;

use App\FormPayment;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class FormPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form_payments = FormPayment::all();
        return view('pago.index', compact('form_payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pago.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $form_payment = new FormPayment($request->except('_token'));
        $form_payment->save();
        flash('Elemento guardado');
        return redirect('/admin/pago');
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
        $form_payment = FormPayment::find($id);
        return view('pago.edit', compact('form_payment'));
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
        $form_payment = FormPayment::find($id);
        $form_payment->fill($request->except('_token'));
        $form_payment->update();
        flash('Elemento guardado');
        return redirect('/admin/pago');
    }
    public function changeStatus($id, $status){
        $form_payment = FormPayment::find($id);
        $form_payment->status = $status;
        $form_payment->update();
        return redirect('/admin/pago');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form_payment = FormPayment::find($id);
        $form_payment->delete();
        flash('Elemento borrado');
        return redirect('/admin/pago');
    }
}

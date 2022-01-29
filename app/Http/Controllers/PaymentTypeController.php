<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentTypeController extends Controller

{
    private $payment_type_name;
    private $lang;
    function __construct(){
        $this->lang=Translation::getLang();
        $this->payment_type_name=PaymentType::getPaymentTypeNameLang();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_type_name=$this->payment_type_name;
        $payment_types= PaymentType::where('status',1)->get();
        return view('admin.includes.payment_types.payment_types')->with(compact(['payment_types','payment_type_name']));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_type_name=$this->payment_type_name;
        $lang=$this->lang;
        return view('admin.includes.payment_types.create')->with(compact(['payment_type_name','lang']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment_type_name=$this->payment_type_name;

        $validated = $request->validate([
            $payment_type_name => 'required',
        ]);
        $payment_type =new PaymentType();
        $payment_type->$payment_type_name=$request->$payment_type_name;
        $payment_type->save();
        $session =Session::flash('message','PaymentType added Successfully');
        return redirect('payment_types')->with(compact(['session','payment_type_name']));

        return redirect()->back();
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
        $payment_type_name=$this->payment_type_name;
        $lang=$this->lang;
        $payment_type = PaymentType::find($id);
        return view('admin.includes.payment_types.update')->with(compact(['payment_type','payment_type_name','lang']));
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
        $payment_type_name=$this->payment_type_name;
        $validated = $request->validate([
            $payment_type_name => 'required',
        ]);
        $payment_type=PaymentType::find($id);
        $payment_type->$payment_type_name = $request->input($payment_type_name);
        $payment_type->update();
        $session =Session::flash('message','PaymentType Updated Successfully');
        return redirect('payment_types')->with(compact('session'));
        //
    }

    public function deletePaymentType($id)
    {
        $payment_type=PaymentType::find($id);
        $payment_type->delete();
        $session =Session::flash('message','PaymentType Deleted Successfully');
        return redirect('payment_types')->with(compact('session'));
    }

}


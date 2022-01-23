<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    private $unit_name;
    private $lang;
    function __construct(){
        $this->lang=Translation::getLang();
        $this->unit_name=Unit::getUnitNameLang();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit_name=$this->unit_name;
        $units= Unit::all();
        return view('admin.includes.units.units')->with(compact(['units','unit_name']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit_name=$this->unit_name;
        $lang=$this->lang;
        return view('admin.includes.units.create')->with(compact(['unit_name','lang']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit_name=$this->unit_name;

        $validated = $request->validate([
            $unit_name => 'required',
        ]);
        $unit =new Unit();
        $unit->$unit_name=$request->$unit_name;
        $unit->save();
        $session =Session::flash('message','Unit added Successfully');
        return redirect('units')->with(compact(['session','unit_name']));

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
        $unit_name=$this->unit_name;
        $lang=$this->lang;
        $unit = Unit::find($id);
        return view('admin.includes.units.update')->with(compact(['unit','unit_name','lang']));
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
        $unit_name=$this->unit_name;
        $validated = $request->validate([
            $unit_name => 'required',
        ]);
        $unit=Unit::find($id);
        $unit->$unit_name = $request->input($unit_name);
        $unit->update();
        $session =Session::flash('message','Unit Updated Successfully');
        return redirect('units')->with(compact('session'));
        //
    }

    public function deleteUnit($id)
    {
        $unit=Unit::find($id);
        $unit->delete();
        $session =Session::flash('message','Unit Deleted Successfully');
        return redirect('units')->with(compact('session'));

    }

}

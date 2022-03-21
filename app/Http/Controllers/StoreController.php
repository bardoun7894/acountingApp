<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Store;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $store_name;
    private $lang;
    /**
     * @var string
     */

    function __construct(){
        $this->lang=Translation::getLang();
        $this->store_name=Store::getStoreNameLang();
    }
    public function index()
    {

        $store_name=$this->store_name;

        $stores =Store::with('branch')->get();

        $branch_name=Branch::getBranchNameLang();
        $lang = $this->lang;
        return view('admin.includes.stores.stores')->with(compact([   'stores','store_name','branch_name','lang']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=$this->lang;
        $branches =Branch::with('stores')->get();
        $store_name=$this->store_name;
        $branch_name=Branch::getBranchNameLang();
        return view('admin.includes.stores.create')->with(compact(['branches','store_name','lang','branch_name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store_name=$this->store_name;
        $validated = $request->validate([
            'branch_id' => 'required',
            $store_name => 'required',
        ]);
        $store =new Store();
        $store->branch_id =$request->branch_id;
        $store->$store_name=$request->$store_name;
        $store->save();
        $session =Session::flash('message',__('messages.data_added'));
        return redirect('stores')->with(compact(['session']));

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
        $lang=$this->lang;
        $store_name=$this->store_name;
        $store = Store::find($id);
        $branch_list=Branch::all();
        $branch_name=Branch::getBranchNameLang();
        return view('admin.includes.stores.update')->with(compact(['store','branch_list','lang','store_name','branch_name']));
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
        $store_name=$this->store_name;
        $validated = $request->validate([
            'branch_id' => 'required',
            $store_name => 'required',
        ]);
        $store=Store::find($id);
        $store->branch_id = $request->branch_id;
        $store->$store_name = $request->input($store_name);
        $store->update();
        $session =Session::flash('message',__('messages.data_updated'));
        return redirect('stores')->with(compact(['session']));

    }


    public function deleteStore($id)
    {
        $store=Store::find($id);
        $store->delete();
        $session =Session::flash('message',__('messages.data_removed'));
        return redirect('stores')->with(compact('session'));

    }
//    public function getSelectedBranch(Request $request)
//    {
//        $store_name = $this->store_name;
//        if ($request->ajax()) {
//            $data = $request->all();
//
//            if (is_numeric($data['tableid'])) {
//
//                $storeData = Store::find($data['tableid']);
//            }
//            else
//            {
//                $storeData = "";
//            }
//
//            $getstores = Store::with('substores')->where(['branch_id' => $data['branch_id'], 'parent_id' => 0])->get();
//            return view('admin.includes.stores.append_parent_level')->with(compact(['storeData', 'getstores', 'store_name']));
//
//
//        }
//
//    }

}

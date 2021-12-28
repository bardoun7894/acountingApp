<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $category_name;
    private $lang;
     function __construct(){
         $this->lang=Translation::getLang();
        $this->category_name=Category::getCategoryNameLang($this->lang);
    }
    public function index()
    {
        $category_name=$this->category_name;
//        $categories =Category::all();
        $branches =Branch::with('categories')->get();
        $branch_name=Branch::getBranchNameLang();
        $lang=$this->lang;
        return view('admin.includes.categories.categories')->with(compact([ 'branches','category_name','branch_name','lang']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=$this->lang;
        $branches =Branch::with('categories')->get();
        $category_name=$this->category_name;
        $branch_name=Branch::getBranchNameLang();
        return view('admin.includes.categories.create')->with(compact(['branches','category_name','lang','branch_name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_name=$this->category_name;
        $validated = $request->validate([
           'branch_id' => 'required',
            $category_name => 'required',
        ]);
        $category =new Category();
        $category->branch_id =$request->branch_id;
        $category->$category_name=$request->$category_name;
        $category->save();
        $session =Session::flash('message',__('messages.category_added'));

        return redirect('categories')->with(compact(['session']));

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
        $category_name=$this->category_name;
        $category = Category::find($id);
        $branche =Branch::where('id',$category->branch_id)->first();
        $branch_list=Branch::all();
        $branch_name=Branch::getBranchNameLang();

//        return $branch;
        return view('admin.includes.categories.update')->with(compact(['category','branche','branch_list','lang','category_name','branch_name']));
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

        $category_name=$this->category_name;
        $validated = $request->validate([
           'branch_id' => 'required',
            $category_name => 'required',
               ]);
        $category=Category::find($id);
        $category->branch_id = $request->branch_id;
        $category->$category_name = $request->input($category_name);
        $category->update();

        $session =Session::flash('message',__('messages.category_updated'));
        return redirect('categories')->with(compact(['session']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category=Category::find($id);
        $category->delete();
        $session =Session::flash('message',__('messages.category_deleted'));
        return redirect('categories')->with(compact('session'));

    }

}

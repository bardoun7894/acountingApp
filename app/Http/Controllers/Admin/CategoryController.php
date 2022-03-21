<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\PurchaseCartDetail;
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
          $branches =Branch::where('status',1)->with('categories')->get();
          $purchases = PurchaseCartDetail::all();
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
        $branches =Branch::where('status',1)->with('categories')->get();
//        return $branches;
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
           'parent_id' => 'required',
            $category_name => 'required',
        ]);
        $category =new Category();
        $category->branch_id =$request->branch_id;
        $category->parent_id =$request->parent_id;
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
        $categoryData = Category::find($id);
        $branch_list=Branch::where('status',1)->get();
        $getCategory= Category::with('subCategories')->where(['parent_id'=>0,'branch_id'=>$categoryData->branch_id])->get();
        $branch_name=Branch::getBranchNameLang();
        return view('admin.includes.categories.update')->with(compact(['categoryData','getCategory','branch_list','lang','category_name','branch_name']));
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


    public function deleteCategory($id)
    {
        $category=Category::find($id);
        $category->delete();
        $session =Session::flash('message',__('messages.category_deleted'));
        return redirect('categories')->with(compact('session'));

    }
//    public function getSelectedBranch(Request $request){
//        $category_name=$this->category_name;
//            if($request->ajax()){
//                $data=$request->all();
//                if($data['tableName']=="categories"){
//                if(is_numeric( $data['tableid']) )  {
//                  $categoryData =  Category::find($data['tableid']);
//
//                } else{
//                    $categoryData =  "";
//                }
//             $getCategories = Category::with('subCategories')->where(['branch_id' => $data['branch_id'],'parent_id'=>0])->get();
//
//                    return view('admin.includes.categories.append_parent_level')->with(compact(['categoryData','getCategories','category_name']));
//
//
//                } else{
//
//                    if(is_numeric( $data['tableid']) )  {
//
//                        $categoryData =  Category::find($data['input_category_id']);
//
//                    } else{
//                        $categoryData =  "";
//                    }
//
//                    $getCategories = Category::with('subCategories')->where(['branch_id' => $data['branch_id'],'parent_id'=>0])->get();
//
//                    return view('admin.includes.purchases.append_category_level')->with(compact(['categoryData','getCategories','category_name']));
//
//
//                }
//
//
//            }
//    }
    public function getSelectedBranch(Request $request)
    {
        $category_name = $this->category_name;
        if ($request->ajax()) {
            $data = $request->all();

            if (is_numeric($data['tableid'])) {

                $categoryData = Category::find($data['tableid']);
            }
            else
            {
                $categoryData = "";
            }

            $getCategories = Category::with('subCategories')->where(['branch_id' => $data['branch_id'], 'parent_id' => 0])->get();
            return view('admin.includes.categories.append_parent_level')->with(compact(['categoryData', 'getCategories', 'category_name']));


        }

    }

}

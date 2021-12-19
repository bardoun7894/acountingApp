<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categories =Category::all();
        $branches =Branch::with('categories')->get();

        return view('admin.ltr.includes.categories.categories')->with(compact([ 'branches']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches =Branch::with('categories')->get();

        return view('admin.ltr.includes.categories.create')->with(compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required',
            'category_name' => 'required',
        ]);
        $category =new Category();
        $category->branch_id =$request->branch_id;
        $category->category_name =$request->category_name;
        $category->save();

        $session =Session::flash('message','Category added Successfully');
        return redirect('categories')->with(compact('session'));

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
        $category = Category::find($id);
        $branche =Branch::where('id',$category->branch_id)->first();
        $branch_list=Branch::all();
//        return $branch;
        return view('admin.ltr.includes.categories.update')->with(compact(['category','branche','branch_list']));
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
        $validated = $request->validate([
           'branch_id' => 'required',
           'category_name' => 'required',
               ]);
        $category=Category::find($id);
        $category->branch_id = $request->branch_id;
        $category->category_name = $request->input('category_name');
        $category->update();

        $session =Session::flash('message','Category Updated Successfully');
        return redirect('categories')->with(compact('session'));

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
        $session =Session::flash('message','Category Deleted Successfully');
        return redirect('categories')->with(compact('session'));

    }

}

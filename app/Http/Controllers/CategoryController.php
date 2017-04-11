<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;

use Validator;

class CategoryController extends Controller
{

    public function __construct(Category $category)
    {
        $this->category = $category;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        //$category = DB::table('categories')->
        $category = $this->category->get()->where('user_id',$id);
        //$category = DB::table('categories')->get()->first();
        return view('categories', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->with('msg',"Fill the field!");

        }
        $category_name = $request->input('category_name');
        $user_id = Auth::user()->id;
        $response = $this->category->create([
            'category_name'  => $category_name,
            'user_id'        => $user_id   
        ]);
        if($response) {
            return redirect()->back()->with('success', 'Category has created successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
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
        //
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
  
        $new_category = $request->input('edit_category');
        //dd($new_category);
        $response = $this->category->where('id',$id)->update(['category_name' => $new_category]);
        if($response){
            return redirect()->back()->with('edited', 'Category edited successfully!');
        }else{
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->category->where('id',$id)->delete();
        if($res){
            return redirect()->back();
        }else{
            return redirect()->back()->with('msg', 'Something went wrong!');
        }
    }
}

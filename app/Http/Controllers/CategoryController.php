<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use Validator;
use App\Contracts\CategoryServiceInterface;

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
    public function index(CategoryServiceInterface $category_service)
    {
        $category = $category_service->getCategoriesByUserId(Auth::id());
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
    public function store(Request $request, CategoryServiceInterface $category_service)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('msg', "Fill the field!");
        }

        $category_name = $request->input('category_name');
        $response = $category_service->storeCategory($category_name);

        if ($response) {
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
    public function update(Request $request, CategoryServiceInterface $category_service, $id)
    {
        $new_category_name = $request->input('edit_category');
        $response = $category_service->updateCategoryName($id, $new_category_name);

        if ($response) {
            return redirect()->back()->with('edited', 'Category edited successfully!');
        } else {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryServiceInterface $category_service, $id)
    {
        $response = $category_service->deleteCategory($id);

        if ($response) {
            return redirect()->back()->with('msg', 'Category deleted successfully!');
        } else {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }
}

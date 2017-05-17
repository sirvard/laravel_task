<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use Validator;
use App\Contracts\CategoryServiceInterface;
use App\Http\Requests\CategoryRequest;


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
    public function index(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->getCategoriesByUserId(Auth::id());
        return response()->json(['status' => 'success', 'categories' => $categories]);   
    }

    public function getCategory(CategoryServiceInterface $categoryService, $id)
    {
        $category = $categoryService->getCategoriesById($id);
        return response()->json(['status' => 'success', 'category' => $category]);   
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
    public function store(CategoryRequest $request, CategoryServiceInterface $categoryService)
    {
        //dd($request->input('category'));
/*        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('msg', "Fill the field!");
        }*/

        $category_name = $request->input('category');
        $response = $categoryService->storeCategory($category_name);

        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Category added successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
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
    public function update(Request $request, CategoryServiceInterface $categoryService, $id)
    {
        //dd($request->all());
        $new_category_name = $request->input('new_category_name');
        $response = $categoryService->updateCategoryName($id, $new_category_name);

        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Category edited successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryServiceInterface $categoryService, $id)
    {

        $response = $categoryService->deleteCategory($id);
        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
        }
    }
}

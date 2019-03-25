<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        $categories = Category::orderBy('created_at')->paginate(5);
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->orderBy('created_at')->get();
        return view('categories.create', ['categories' => $categories, 'splitter' => ""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'parent_id' => 'integer'
        ]);
        $category = new Category($request->all());
        $category->save();
        return redirect()->route('category.index')->with('status', 'Record created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', 0)->orderBy('created_at')->get();
        return view('categories.edit', ['categories' => $categories, 'category' => $category, 'splitter' => '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|string|max:100',
            'parent_id' => 'integer'
        ]);


        foreach ($category->children as $children)
        {
            $children->parent_id = $category->parent_id;
            $children->save();
        }


        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();


        return redirect()->route('category.index')->with('status', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        foreach ($category->children as $children)
        {
            $children->parent_id = $category->parent_id;
            $children->save();
        }

        $category->delete();

        return redirect()->route('category.index')->with('status', 'Record deleted successfully!');
    }
}

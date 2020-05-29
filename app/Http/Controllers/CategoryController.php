<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );

        $categories = new Category();

        if(! empty($input['keyword'])) {
            $categories = $categories->where('name', 'like', '%'. $input['keyword'] . '%');
        } else if (! empty($input['category'])) {
            $categories = $categories->where('name', 'like', '%'. $input['category'] . '%');
        }

        $categories = $categories->orderBy('updated_at', 'desc');

        $categories = $categories->paginate(10);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['name' => 'required']);

        if($request->hasFile('photo')){ 
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/avatars', $fileNameToStore);
          }

        Category::create([

            'name' => $request->name,
            'photo' => isset($fileNameToStore) ? $fileNameToStore : ''

        ]);

        Session::flash('flash_message', 'Category added successfully');
        Session::flash('alert', 'alert-success');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $this->validate($request, ['name' => 'required', 'discount' => 'required']);

        $category = Category::find($id);

        if($request->hasFile('photo')){ 
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/avatars', $fileNameToStore);
          }

        $category->name = $request->name;
        isset($fileNameToStore) ? $category->photo = $fileNameToStore : '';
        $category->discount = $request->discount;

        $category->save();

        Session::flash('flash_message', 'Category updated successfully');
        Session::flash('alert', 'alert-success');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        
        Session::flash('flash_message', 'Category deleted successfully');
        Session::flash('alert', 'alert-success');

        return redirect()->route('category.index');
    }
}

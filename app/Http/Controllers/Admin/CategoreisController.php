<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Core\File;
use Illuminate\Support\Facades\File as FacadesFile;

class CategoreisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::orderByDesc('id')->paginate(10);

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::select(['id','name'])->get();

        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'image'=>'required|image|mimes:png,jpg,jpeg,svg',
            'parent_id'=>'nullable|exists:categories,id',
        ]);

        // dd($request->all());

        $image =$request->file('image');
        $new_img_name = rand().time(). '-'.strtolower(str_replace(' ','-', $image->getClientOriginalName()));
        $image->move(public_path('uploads/images/categories/'), $new_img_name);

        $data=$request->all();
        $data['image'] = $new_img_name;

        Category::create($data);

        return redirect()-> route('admin.categories.index')->with('msg','category created successfuly')->with('type','success');


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
        $categories = Category::select(['id','name'])->get();
        $category =  Category::findOrFail($id);

        return view('admin.categories.edit', compact('categories','category'));
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
        $request->validate([
            'name'=>'required|min:3',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,svg',
            'parent_id'=>'nullable|exists:categories,id',
        ]);


        $category =  Category::findOrFail($id);
        $new_img_name=$category->image;

        if($request->hasFile('image')){

                FacadesFile::delete(public_path('uploads/images/categories/'.$new_img_name));

            $new_img_name=rand().rand()."_" .$request ->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images/categories/'),$new_img_name);
              }


        $data=$request->all();
        $data['image'] = $new_img_name;

        $category->update($data);

        return redirect()-> route('admin.categories.index')->with('msg','category updated successfuly')->with('type','info');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $category = Category::findOrFail($id);

            FacadesFile::delete(public_path('uploads/images/categories/'. $category->image));

            Category::where('parent_id',$category->id)->update(['parent_id' =>null]);

            $category->delete();



              return redirect()->route('admin.categories.index')->with('msg','category deleted successfuly')->with('type','danger');
    }
}

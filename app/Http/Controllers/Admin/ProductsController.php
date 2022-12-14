<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\File as FacadesFile;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(5);
        $categories= Category::select(['id','name'])->get();
        return view('admin.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::all();
        $categories= Category::select(['id','name'])->get();

        return view('admin.products.create',compact('products','categories'));

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
            'description'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);

        $image =$request->file('image');
        $new_img_name = rand().time(). '-'.strtolower(str_replace(' ','-', $image->getClientOriginalName()));
        $image->move(public_path('uploads/images/products/'), $new_img_name);

        $data=$request->all();
        $data['image'] = $new_img_name;

        Product::create($data);

        return redirect()-> route('admin.products.index')->with('msg','product created successfuly')->with('type','success');



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
        $products = product::select(['id','name'])->get();
        $product =  product::findOrFail($id);
        $categories= Category::select(['id','name'])->get();


        return view('admin.products.edit', compact('products','product','categories'));
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
            'description'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);


        $product =  product::findOrFail($id);
        $new_img_name=$product->image;

        if($request->hasFile('image')){

                FacadesFile::delete(public_path('uploads/images/products/'.$new_img_name));

            $new_img_name=rand().rand()."_" .$request ->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images/products/'),$new_img_name);
              }


        $data=$request->all();
        $data['image'] = $new_img_name;

        $product->update($data);

        return redirect()-> route('admin.products.index')->with('msg','product updated successfuly')->with('type','info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        FacadesFile::delete(public_path('uploads/images/products/'. $product->image));
        $product->delete();

          return redirect()->route('admin.products.index')->with('msg','product deleted successfuly')->with('type','danger');
    }
}

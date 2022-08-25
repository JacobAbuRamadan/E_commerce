<?php

namespace App\Http\Controllers\MainSite;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteManagementController extends Controller
{
    //
    public function HomePage(){
        $categories=Category::where('parent_id','=',null)->get();
        $products=Product::orderBy('id','DESC')->paginate(6);

        return response()->view('MainSite.home',
        ['categories'=>$categories,'products'=>$products]);
    }


    public function ShopPage(){
        $categories=Category::where('parent_id','=',null)->get();
        $subCategories=Category::where('parent_id','!=',null)->get();
        $products=Product::orderBy('id','DESC')->paginate(12);

        return response()->view('MainSite.shop',
        ['categories'=>$categories,'subCategories'=>$subCategories,'products'=>$products]);
    }


    public function ShopCategory(Request $request, Category $category){
        $categories=Category::where('parent_id','=',null)->get();
        $subCategories=Category::where('parent_id','!=',null)->get();

        $products=Product::where('category_id','=',9)->paginate(12);
        
        return response()->view('MainSite.shop',
        ['categories'=>$categories,'subCategories'=>$subCategories,'products'=>$products]);
    
    }


    public function ShopSubCategory(Category $subCategory){
        $categories=Category::where('parent_id','=',null)->get();
        $subCategories=Category::where('parent_id','!=',null)->get();
        $products=Product::where('category_id','=',$subCategory->parent_id)->paginate(12);

        return response()->view('MainSite.shop',
        ['categories'=>$categories,'subCategories'=>$subCategories,'products'=>$products]);
    
    }


    public function ProductPage(Product $product){
        $products=Product::where('category_id','=',$product->category_id)->get();
        $categories=Category::all();
        return response()->view('MainSite.productDetail',
        ['product'=>$product,'products'=>$products,'categories'=>$categories]);
    }


    public function Message(Request $request){
        $validator=validator($request->all(),[
            'name'=>'required|string|min:3|max:100',
            'email'=>'required|email',
            'subject'=>'required|string',
            'message'=>'required|string',
            
        ]);

        if(!$validator->fails()){
            $message=new Message();
            $message->name=$request->input('name');
            $message->email=$request->input('email');
            $message->subject=$request->input('subject');
            $message->message=$request->input('message');
            $isSaved=$message->save();

            return response()->json([
                'message'=>$isSaved ? 'sent succesfully' : 'send failed']
                ,$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        };
    }


    public function ShowCart(){
        
    }

    public function AddCart(){

    }

}

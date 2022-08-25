<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users=User::count();
        $categories=Category::count();
        $products=Product::count();
        $quantity=Product::sum('quantity');
        return view('admin.index',compact('users','categories','products','quantity'));
    }

    public function dash()
    {
        return view('admin.dash');
    }
}


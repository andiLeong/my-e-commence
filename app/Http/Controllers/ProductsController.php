<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('home.product.index');
    }

    public function show($slug)
    {
        return view('home.product.show',compact('slug'));
    }
}

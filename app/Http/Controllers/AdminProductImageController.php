<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductImageController extends Controller
{
    public function __invoke($id)
    {
        return view('admin.product-image.edit',['product_id' => $id]);
    }
}

<?php
namespace App\Http\Controllers;

class AdminProductCoverController extends Controller
{
    public function __invoke($id)
    {
        return view('admin.product-cover.edit',['product_id' => $id]);
    }
}

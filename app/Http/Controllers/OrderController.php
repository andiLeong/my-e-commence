<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->withOrderTotalPrice()->latest()->paginate(2);
//        return $orders;
        return View::make('home.order.index', compact('orders'));
    }
}

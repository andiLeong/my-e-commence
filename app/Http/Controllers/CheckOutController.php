<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CheckOutController extends Controller
{
    public function index()
    {
        return View::make('home.checkout.index');
    }
}

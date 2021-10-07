<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function edit($id)
    {
        return view('admin.user.edit', ['user_id' => $id]);
    }
}

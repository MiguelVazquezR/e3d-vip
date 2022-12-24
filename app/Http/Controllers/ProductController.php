<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Products/Index');
    }

    public function requestNew(Request $request)
    {
        return $request->all();
    }
}

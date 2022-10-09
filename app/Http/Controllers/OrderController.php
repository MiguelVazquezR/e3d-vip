<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Orders/Index');
    }

    public function create(Request $request)
    {
        return inertia('Orders/Create');
    }
}

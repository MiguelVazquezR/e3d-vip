<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PointRubricController extends Controller
{
    public function index()
    {
        return Inertia::render("PointsRubric/Index");
    }
}

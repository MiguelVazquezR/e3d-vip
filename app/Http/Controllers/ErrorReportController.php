<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreErrorReportsRequest;
use App\Models\ErrorReport;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ErrorReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        return Inertia::render('ErrorReport/Index');

    }

    public function store(StoreErrorReportsRequest $request) 
    {
        ErrorReport::create($request->validated() + ['user_id' => auth()->id()]);
        // $report->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        request()->session()->flash('flash.banner','Se ha enviado tu reporte. Muchas gracias por tu retroalimentación');
        request()->session()->flash('flash.bannerStyle','success');

        return redirect()->route('dashboard');
    }
    
    // public function markAsRead(ErrorReportModel $error) 
    // {
    //     $error->update(['is_read'  => 1]);
    //     return back()->with('message', 'Marcado como leido');
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\ErrorReports;
use App\Http\Requests\StoreErrorReportsRequest;
use App\Http\Requests\UpdateErrorReportsRequest;

class ErrorReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreErrorReportsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreErrorReportsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ErrorReports  $errorReports
     * @return \Illuminate\Http\Response
     */
    public function show(ErrorReports $errorReports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ErrorReports  $errorReports
     * @return \Illuminate\Http\Response
     */
    public function edit(ErrorReports $errorReports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateErrorReportsRequest  $request
     * @param  \App\Models\ErrorReports  $errorReports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateErrorReportsRequest $request, ErrorReports $errorReports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ErrorReports  $errorReports
     * @return \Illuminate\Http\Response
     */
    public function destroy(ErrorReports $errorReports)
    {
        //
    }
}

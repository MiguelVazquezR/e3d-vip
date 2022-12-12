<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AwardController extends Controller
{
    
    public function index()
    {
        $awards = Award::all();
        return inertia('Awards/Index',compact('awards'));
    }

    public function history()
    {
        $awards = auth()->user()->awards;
        return inertia('Awards/History',compact('awards'));
    }

    public function trade(Request $request )
    {
        auth()->user()->awards()->attach($request->award_id);
        User::find(auth()->id())->decrement('points', Award::find($request->award_id)->points);

        request()->session()->flash('flash.banner','Se ha canjeado correctamente. Su premio será procesado');
        request()->session()->flash('flash.bannerStyle','success');

        return redirect()->route('awards.history');
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
     * @param  \App\Http\Requests\StoreAwardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAwardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAwardRequest  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAwardRequest $request, Award $award)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        //
    }
}

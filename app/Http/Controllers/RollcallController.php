<?php

namespace App\Http\Controllers;

use App\Models\Rollcall;
use Illuminate\Http\Request;

class RollcallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('rollcall.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rollcall  $rollcall
     * @return \Illuminate\Http\Response
     */
    public function show(Rollcall $rollcall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rollcall  $rollcall
     * @return \Illuminate\Http\Response
     */
    public function edit(Rollcall $rollcall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rollcall  $rollcall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rollcall $rollcall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rollcall  $rollcall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rollcall $rollcall)
    {
        //
    }
}

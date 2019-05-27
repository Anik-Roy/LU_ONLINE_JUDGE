<?php

namespace App\Http\Controllers;

use App\Tried;
use Illuminate\Http\Request;

class TriedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * @param  \App\Tried  $tried
     * @return \Illuminate\Http\Response
     */
    public function show(Tried $tried)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tried  $tried
     * @return \Illuminate\Http\Response
     */
    public function edit(Tried $tried)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tried  $tried
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tried $tried)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tried  $tried
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tried $tried)
    {
        //
    }
}

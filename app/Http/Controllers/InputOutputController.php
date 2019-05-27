<?php

namespace App\Http\Controllers;

use App\InputOutput;
use Illuminate\Http\Request;

class InputOutputController extends Controller
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
     * @param  \App\InputOutput  $inputOutput
     * @return \Illuminate\Http\Response
     */
    public function show(InputOutput $inputOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InputOutput  $inputOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(InputOutput $inputOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputOutput  $inputOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InputOutput $inputOutput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputOutput  $inputOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(InputOutput $inputOutput)
    {
        //
    }
}

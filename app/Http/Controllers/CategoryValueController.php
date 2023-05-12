<?php

namespace App\Http\Controllers;

use App\Models\Assembly;
use App\Models\CategoryValue;
use Illuminate\Http\Request;

class CategoryValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assembly = Assembly::find(auth()->user()->getCurrentAssembly());
        return view('category-values.index', ['assembly' => $assembly]);
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
     * @param  \App\Models\CategoryValue  $categoryValue
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryValue $categoryValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryValue  $categoryValue
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryValue $categoryValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryValue  $categoryValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryValue $categoryValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryValue  $categoryValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryValue $categoryValue)
    {
        //
    }
}

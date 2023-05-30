<?php

namespace App\Http\Controllers;

use App\Models\Find;
use Illuminate\Http\Request;

class FindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.receptionist.find');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Find $find)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Find $find)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Find $find)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Find $find)
    {
        //
    }
}

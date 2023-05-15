<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorerekeningRequest;
use App\Http\Requests\UpdaterekeningRequest;
use App\Models\rekening;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('boilerplate::rekening.index');
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
    public function store(StorerekeningRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rekening $rekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaterekeningRequest $request, rekening $rekening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rekening $rekening)
    {
        //
    }
}

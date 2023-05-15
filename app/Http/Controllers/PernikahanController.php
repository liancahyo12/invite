<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepernikahanRequest;
use App\Http\Requests\UpdatepernikahanRequest;
use App\Models\pernikahan;
use Spatie\Html\Elements\Form;

class PernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('boilerplate::pernikahan.index');
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
    public function store(StorepernikahanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pernikahan $pernikahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pernikahan $pernikahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepernikahanRequest $request, pernikahan $pernikahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pernikahan $pernikahan)
    {
        //
    }
}

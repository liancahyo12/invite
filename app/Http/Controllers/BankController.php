<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorebankRequest;
use App\Http\Requests\UpdatebankRequest;
use App\Models\bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('boilerplate::bank.index');
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
    public function store(StorebankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebankRequest $request, bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bank $bank)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepernikahanRequest;
use App\Http\Requests\UpdatepernikahanRequest;
use App\Models\pernikahan;
use Spatie\Html\Elements\Form;
use Auth;

class PernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasPermission('backend_access')) {
            return view('boilerplate::pernikahan.index');
        }

        if (pernikahan::where([['user_id', '=',Auth::user()->id], ['deleted_at', '=', NULL]])->count() == 0) {
            return view('boilerplate::pernikahan.create');
        }
        return view('boilerplate::pernikahan.show');
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

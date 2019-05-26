<?php

namespace App\Http\Controllers;

use App\Disc;
use App\Services\DiscService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDisc;
use App\Http\Requests\UpdateDisc;

class DiscController extends Controller
{
    public function __construct(DiscService $disc)
    {
        $this->disc = $disc;
        $this->authorizeResource(Disc::class);
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discs = Disc::All();
        return view('discs.index')->with('discs', $discs);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisc $request)
    {
        Department::create($request->validated());
        return redirect()->route('discs.index')->with('success', __('discs.successfully_stored'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disc  $disc
     * @return \Illuminate\Http\Response
     */
    public function edit(Disc $disc)
    {
        //TODO
        //Return view with edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disc  $disc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisc $request, Disc $disc)
    {
        $disc->update($request->validated());
        return redirect()->route('discs.index')->with('success', __('discs.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disc  $disc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disc $disc)
    {
        $this->disc->destroy($disc);
        return redirect()->route('discs.index')->with('success', __('discs.successfully_deleted'));
    }
}

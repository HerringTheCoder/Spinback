<?php

namespace App\Http\Controllers;

use App\Parcel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreParcel;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parcels = Parcel::All();
        return view('parcels.index')->with('parcels', $parcels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParcel $request)
    {
        Parcel::Create($request->validated());
        return redirect()->route('parcels.index')->with('success', __('parcels.successfully_stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(StoreParcel $request, Parcel $parcel)
    {
        $parcel->update($request->validated());
        return redirect()->route('parcels.index')->with('success', __('parcels.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        return redirect()->route('parcels.index')->with('success', __('parcels.successfully_deleted'));
    }
}

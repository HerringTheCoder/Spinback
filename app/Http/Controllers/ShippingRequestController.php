<?php

namespace App\Http\Controllers;

use App\ShippingRequest;
use App\Http\Requests\StoreShippingRequest;
use App\Http\Requests\UpdateShippingRequest;

class ShippingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippingRequests = ShippingRequest::All();
        return view('shippingrequests.index')->with('shippingRequests', $shippingRequests);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingRequest $request)
    {
        ShippingRequest::Create($request->validated());
        return redirect()->route('shippingrequests.index')->with('success', __('shippingrequests.successfully_stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShippingRequest  $shippingRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingRequest $shippingRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShippingRequest  $shippingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingRequest $request, ShippingRequest $shippingRequest)
    {
        $shippingRequest->update($request->validated());
        return redirect()->route('shippingrequests.index')->with('success', __('shippingrequests.successfully_stored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShippingRequest  $shippingRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingRequest $shippingRequest)
    {
        $shippingRequest->delete();
        return redirect()->route('shippingrequests.index')->with('success', __('shippingrequests.successfully_stored'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DeliveryRequest;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;

class DeliveryRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryRequests = DeliveryRequest::All();
        return view('deliveryrequests.index')->with('deliveryRequests', $deliveryRequests);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryRequest $request)
    {
        DeliveryRequest::Create($request->validated());
        return redirect()->route('delivery_requests.index')->with('success', __('delivery_requests.successfully_stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryRequest  $deliveryRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryRequest $deliveryRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryRequest  $deliveryRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryRequest $request, DeliveryRequest $deliveryRequest)
    {
        $deliveryRequest->update($request->validated());
        return redirect()->route('delivery_requests.index')->with('success', __('delivery_requests.successfully_stored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryRequest  $deliveryRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryRequest $deliveryRequest)
    {
        $deliveryRequest->delete();
        return redirect()->route('delivery_requests.index')->with('success', __('delivery_requests.successfully_stored'));
    }
}

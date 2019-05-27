<?php

namespace App\Http\Controllers;

use App\Metadata;
use App\Services\MetadataService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMetadata;
use App\Http\Requests\StoreMetadata;

class MetadataController extends Controller
{
    public function __construct(MetadataService $metadata)
    {
        $this->metadata = $metadata;
        $this->authorizeResource(Metadata::class);
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metadata = Metadata::All();
        return view('metadata.index')->with('metadata', $metadata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetadata $request)
    {
        Metadata::Create($request->validated());
        return redirect()->route('metadata.index')->with('success', __('metadata.successfully_stored'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function edit(Metadata $metadata)
    {
        //TODO: Return view with edit form (probably not recommended)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetadata $request, Metadata $metadata)
    {
        $metadata->update($request->validated());
        return redirect()->route('metadata.index')->with('success', __('metadata.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metadata $metadata)
    {
        $metadata->delete();
        return redirect()->route('metadata.index')->with('success', __('metadata.successfully_deleted'));
    }
}

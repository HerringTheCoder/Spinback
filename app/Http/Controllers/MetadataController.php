<?php

namespace App\Http\Controllers;

use App\Metadata;
use App\Services\MetadataService;
use Illuminate\Http\Request;

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
        $metatable= $this->metadata->index();
        $message = session('message');
        return view('test.metadata.panel')->with('metatable', $metatable)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO: Return metadata field creation form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->metadata->validateStore($request);
        $this->metadata->store($request);
        return redirect()->action('MetadataController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function show(Metadata $metadata)
    {
        //TODO: return single metadata field view
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
    public function update(Request $request, Metadata $metadata)
    {
        $this->metadata->validateUpdate($request);
        $this->metadata->update($metadata, $request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metadata $metadata)
    {
        $this->metadata->destroy($metadata);
        return redirect()->action('MetadataController@index');
    }
}

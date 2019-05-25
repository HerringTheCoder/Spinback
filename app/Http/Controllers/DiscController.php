<?php

namespace App\Http\Controllers;

use App\Disc;
use App\Services\DiscService;
use Illuminate\Http\Request;

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
        $discs=$this->disc->index();
        $message = session('message');
        return view('test.discs.panel')->with('discs', $discs)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO
        //return view with creation form here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->disc->validateStore($request);
        $this->disc->store($request);
        return redirect()->action('DiscController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disc  $disc
     * @return \Illuminate\Http\Response
     */
    public function show(Disc $disc)
    {
        //TODO
        //return single disc view
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
    public function update(Request $request, Disc $disc)
    {
        $this->disc->validateUpdate($request);
        $this->disc->update($disc, $request);
        return back();
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
        return redirect()->action('DiscController@index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Disc;
use App\Services\DiscService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDisc;
use App\Http\Requests\UpdateDisc;
use App\Department;
use App\Album;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        $departments = Department::all();
        $query = $this->disc->query($request);
        $discs = $query[0]->simplePaginate(20);
        $album = $query[1];
        return view('discs.index')->with(compact('discs', 'departments', 'album'));
    }

    public function show(Disc $disc)
    {
        return view('discs.show')->with(compact('disc'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisc $request)
    {
        $disc = Disc::create([
            'album_id' => $request->input('album'),
            'department_id' => $request->input('department'),
            'offer_price' => $request->input('offer_price'),
            'condition' => $request->input('condition')
        ]);
        Log::info('Disc #' . $disc->id . ' created by ' . Auth::user()->fullName);
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
        return view('discs.edit')->with(compact('disc'));
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
        Log::info('Disc #' . $disc->id . ' deleted by ' . Auth::user()->fullName);
        $disc->delete();
        return redirect()->route('discs.index')->with('success', __('discs.successfully_deleted'));
    }
}

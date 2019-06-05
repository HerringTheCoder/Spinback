<?php

namespace App\Http\Controllers;

use App\Disc;
use App\Services\DiscService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDisc;
use App\Http\Requests\UpdateDisc;
use App\Department;
use App\Album;

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
        $query = Disc::query();
        $album = null;
        if ($request->filled('album')) {
            $query->where('album_id', $request->input('album'));
            $album = Album::where('id', $request->input('album'))->first();
        }
        if ($request->filled('department')) {
            $query->department($request->input('department'));
        }
        $query->orderBy('created_at', 'desc');
        $query->with('album.artist')->with('department')->get();
        $discs = $query->simplePaginate(20);
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
        Disc::create([
            'album_id' => $request->input('album'),
            'department_id' => $request->input('department'),
            'offer_price' => $request->input('offer_price'),
            'condition' => $request->input('condition')
        ]);
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
        $disc->delete();
        return redirect()->route('discs.index')->with('success', __('discs.successfully_deleted'));
    }
}

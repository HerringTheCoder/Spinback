<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Transaction;
use App\Disc;
use App\Parcel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $counts = [
            'departments' => Department::count(),
            'transactions' => Transaction::count(),
            'discs' => Disc::count(),
            'parcels' => Parcel::count()
        ];
        $discs = Disc::latest('id')->take(5)->with('album.artist')->with('department')->get();
        return view('home', compact('counts', 'discs'));
    }

    public function about()
    {
        return view('about');
    }
}

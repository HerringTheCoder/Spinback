<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Transaction;
use App\Disc;
use App\Parcel;
use Carbon\Carbon;

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
            'discs' => Disc::unsold()->count(),
            'parcels' => Parcel::where('completed', 0)->count()
        ];
        $discs = Disc::latest('id')->unsold()->take(5)->with('album.artist')->with('department')->get();
        $sold = Transaction::where('operation_type', 'sale')->latest('updated_at')->take(5)->with('disc.album')->with('department')->get();
        $stats = [
            'trans_last_24h' => Transaction::where('created_at', '>=', Carbon::now()->subDay())->count(),
            'trans_last_week' => Transaction::where('created_at', '>=', Carbon::now()->subWeek())->count(),
        ];
        return view('home.home', compact('counts', 'discs', 'sold', 'stats'));
    }

    public function about()
    {
        return view('home.about');
    }
}

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
        $departments = Department::count();
        $transactions = Transaction::count();
        $discs = Disc::count();
        $parcels = Parcel::count();
        return view('home', compact('departments', 'transactions', 'discs', 'parcels'));
    }

    public function about()
    {
        return view('about');
    }
}

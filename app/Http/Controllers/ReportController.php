<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Album;
use App\Department;

class ReportController extends Controller
{
    public function albums()
    {
        $results = DB::table('transactions')
            ->select(
                'albums.*',
                DB::raw('sum(price) as total'),
                DB::raw('count(albums.id) as count'),
                DB::raw('avg(price) as avg')
            )
            ->join('discs', 'transactions.disc_id', '=', 'discs.id')
            ->join('albums', 'discs.album_id', '=', 'albums.id')
            ->where('transactions.operation_type', '=', 'sale')
            ->groupBy('albums.id')
            ->orderBy('total', 'desc')
            ->take('20')
            ->get()
            ->toArray();

        $models = Album::hydrate($results);

        return view('reports.albums')->with('albums', $models);
    }

    public function departments()
    {
        $results = DB::table('transactions')
            ->select(
                'departments.*',
                DB::raw('sum(price) as total'),
                DB::raw('count(transactions.id) as count'),
                DB::raw('avg(price) as avg')
            )
            ->join('departments', 'transactions.department_id', '=', 'departments.id')
            ->where('transactions.operation_type', '=', 'sale')
            ->groupBy('departments.id')
            ->orderBy('total', 'desc')
            ->take('20')
            ->get()
            ->toArray();

        $models = Department::hydrate($results);

        return view('reports.departments')->with('departments', $models);
    }

    public function monthly()
    {
        $results = DB::table('transactions')
            ->select(
                DB::raw('date(created_at) as date'),
                DB::raw('sum(case when operation_type="sale" then price else 0 end) as total_income'),
                DB::raw('sum(case when operation_type="purchase" then price else 0 end) as total_outcome')
            )
            ->whereRaw('month(updated_at) = month(curdate())')
            ->groupBy('date')
            ->get();

        return view('reports.monthly')->with('results', $results);
    }
}

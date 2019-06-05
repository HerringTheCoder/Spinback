<?php

namespace App\Services;

use App\Album;
use App\Disc;
use Illuminate\Http\Request;

class DiscService
{

    public function query(Request $request)
    {
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
        $query->with('album')->with('department')->get();
        return array($query, $album);
    }
}

<?php

namespace App\Http\Controllers;

class LocalizationController extends Controller
{
    public function locale($locale)
    {
        session(['locale' => $locale]);
        return redirect()->back();
    }
}

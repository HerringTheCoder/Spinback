<?php
namespace App\Services;
use Illuminate\Http\Request;

use App\Mail\Report;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionService
{

    public function report() : void
    {
        $formatted_date = Carbon::now()->subDays(30)->toDateTimeString();
        $transactions = Transaction::where('created_at','>=',$formatted_date)->get();
        Mail::to(Auth::user())->send(new Report($transactions));
        return;
    }
}

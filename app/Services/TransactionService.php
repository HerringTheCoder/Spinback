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
        $income=0; $expense=0; $balance = 0;
        $formatted_date = Carbon::now()->subDays(30)->toDateTimeString();
        $transactions = Transaction::where('created_at','>=',$formatted_date)->get();
        foreach ($transactions as $transaction)
        {
         if($transaction->operation_type==='sell')
         {
             $income+=$transaction->price;
             $balance+=$transaction->price;
         }
            else if($transaction->operation_type==='buy')
            {
                $expense+=$transaction->price;
                $balance-=$transaction->price;
            }
        }
        Mail::to(Auth::user())->send(new Report($transactions, $income,$expense,$balance));
        return;
    }

}
